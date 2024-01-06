<?php

function wcusp_check_update()
{
    $current_version = '3.0.0'; // replace with your current plugin/theme version
    $stored_version = get_option('wcusp_version');

    if ($stored_version !== $current_version) {
        // Run the migration script
        wcusp_migrate_usp_data();

        // Update the stored version to the current version
        update_option('wcusp_version', $current_version);

        // Set a transient to show the admin notice
        set_transient('wcusp_migration_completed', true, 5 * 60); // 5 minutes

        function wcusp_migration_notice()
        {
            if (get_transient('wcusp_migration_completed')) {
                echo '<div class="notice notice-success is-dismissible"><p>' . __('Woo USP data migration completed successfully.', 'wcusp_domain') . '</p></div>';
                delete_transient('wcusp_migration_completed');
            }
        }
        add_action('admin_notices', 'wcusp_migration_notice');
    }
}
add_action('admin_init', 'wcusp_check_update');


function wcusp_migrate_usp_data()
{
    // Get the current options
    $wcusp_options = get_option('wcusp_settings');

    // Check if the migration is needed
    if (isset($wcusp_options['usp1']) || isset($wcusp_options['icon1'])) {
        // Initialize a new array for USPs
        $new_usps = [];

        // Loop through possible USPs and migrate them to the new format
        for ($i = 1; $i <= 5; $i++) {
            if (isset($wcusp_options['usp' . $i]) && !empty($wcusp_options['usp' . $i])) {
                $new_usps[] = [
                    'icon' => $wcusp_options['icon' . $i] ?? '',
                    'text' => $wcusp_options['usp' . $i]
                ];
            }
        }

        // Update the options with the new USP format
        $wcusp_options['usps'] = $new_usps;

        // Remove old usp1, usp2, ... keys
        for ($i = 1; $i <= 5; $i++) {
            unset($wcusp_options['usp' . $i]);
            unset($wcusp_options['icon' . $i]);
        }

        // Save the updated options back to the database
        update_option('wcusp_settings', $wcusp_options);
    }
}

// Run the migration function
wcusp_migrate_usp_data();
