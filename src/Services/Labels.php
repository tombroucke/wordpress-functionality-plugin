<?php

namespace FunctionalityPlugin\Services;

class Labels
{
    /**
     * Get the labels for a post type
     *
     * @param string $singular
     * @param string $plural
     * @return array
     */
    public static function postType(string $singular, string $plural) : array
    {
        return [
            'add_new' => __('Add New', 'functionality-plugin'),
            /* translators: %s: singular post name */
            'add_new_item' => sprintf(__('Add New %s', 'functionality-plugin'), $singular),
            /* translators: %s: singular post name */
            'edit_item' => sprintf(__('Edit %s', 'functionality-plugin'), $singular),
            /* translators: %s: singular post name */
            'new_item' => sprintf(__('New %s', 'functionality-plugin'), $singular),
            /* translators: %s: singular post name */
            'view_item' => sprintf(__('View %s', 'functionality-plugin'), $singular),
            /* translators: %s: plural post name */
            'view_items' => sprintf(__('View %s', 'functionality-plugin'), $plural),
            /* translators: %s: singular post name */
            'search_items' => sprintf(__('Search %s', 'functionality-plugin'), $plural),
            /* translators: %s: plural post name to lower */
            'not_found' => sprintf(__('No %s found.', 'functionality-plugin'), strtolower($plural)),
            /* translators: %s: plural post name to lower */
            'not_found_in_trash' => sprintf(
                __('No %s found in trash.', 'functionality-plugin'),
                strtolower($plural)
            ),
            /* translators: %s: singular post name */
            'parent_item_colon' => sprintf(__('Parent %s:', 'functionality-plugin'), $singular),
            /* translators: %s: singular post name */
            'all_items' => sprintf(__('All %s', 'functionality-plugin'), $plural),
            /* translators: %s: singular post name */
            'archives' => sprintf(__('%s Archives', 'functionality-plugin'), $singular),
            /* translators: %s: singular post name */
            'attributes' => sprintf(__('%s Attributes', 'functionality-plugin'), $singular),
            /* translators: %s: singular post name to lower */
            'insert_into_item' => sprintf(__('Insert into %s', 'functionality-plugin'), strtolower($singular)),
            /* translators: %s: singular post name to lower */
            'uploaded_to_this_item' => sprintf(
                __('Uploaded to this %s', 'functionality-plugin'),
                strtolower($singular)
            ),
            /* translators: %s: plural post name to lower */
            'filter_items_list' => sprintf(__('Filter %s list', 'functionality-plugin'), strtolower($plural)),
            /* translators: %s: singular post name */
            'items_list_navigation' => sprintf(__('%s list navigation', 'functionality-plugin'), $plural),
            /* translators: %s: singular post name */
            'items_list' => sprintf(__('%s list', 'functionality-plugin'), $plural),
            /* translators: %s: singular post name */
            'item_published' => sprintf(__('%s published.', 'functionality-plugin'), $singular),
            /* translators: %s: singular post name */
            'item_published_privately' => sprintf(
                __('%s published privately.', 'functionality-plugin'),
                $singular
            ),
            /* translators: %s: singular post name */
            'item_reverted_to_draft' => sprintf(__('%s reverted to draft.', 'functionality-plugin'), $singular),
            /* translators: %s: singular post name */
            'item_scheduled' => sprintf(__('%s scheduled.', 'functionality-plugin'), $singular),
            /* translators: %s: singular post name */
            'item_updated' => sprintf(__('%s updated.', 'functionality-plugin'), $singular),
        ];
    }

    /**
     * Get the labels for a taxonomy
     *
     * @param string $singular_name
     * @param string $plural_name
     * @return array
     */
    public static function taxonomy(string $singular_name, string $plural_name) : array
    {
        return [
            /* translators: %s: plural taxonomy name */
            'search_items' => sprintf(__('Search %s', 'functionality-plugin'), $plural_name),
            /* translators: %s: plural taxonomy name */
            'popular_items' => sprintf(__('Popular %s', 'functionality-plugin'), $plural_name),
            /* translators: %s: plural taxonomy name */
            'all_items' => sprintf(__('All %s', 'functionality-plugin'), $plural_name),
            /* translators: %s: singular taxonomy name */
            'parent_item' => sprintf(__('Parent %s', 'functionality-plugin'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'parent_item_colon' => sprintf(__('Parent %s:', 'functionality-plugin'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'edit_item' => sprintf(__('Edit %s', 'functionality-plugin'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'view_item' => sprintf(__('View %s', 'functionality-plugin'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'update_item' => sprintf(__('Update %s', 'functionality-plugin'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'add_new_item' => sprintf(__('Add New %s', 'functionality-plugin'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'new_item_name' => sprintf(__('New %s Name', 'functionality-plugin'), $singular_name),
            /* translators: %s: plural taxonomy name to lower */
            'separate_items_with_commas' => sprintf(
                __('Separate %s with commas', 'functionality-plugin'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural taxonomy name to lower */
            'add_or_remove_items' => sprintf(
                __('Add or remove %s', 'functionality-plugin'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural taxonomy name to lower */
            'choose_from_most_used' => sprintf(
                __('Choose from most used %s', 'functionality-plugin'),
                strtolower($plural_name)
            ),
            /* translators: %s: plural taxonomy name to lower */
            'not_found' => sprintf(__('No %s found', 'functionality-plugin'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name to lower */
            'no_terms'  => sprintf(__('No %s', 'functionality-plugin'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name */
            'items_list_navigation' => sprintf(__('%s list navigation', 'functionality-plugin'), $plural_name),
            /* translators: %s: plural taxonomy name */
            'items_list' => sprintf(__('%s list', 'functionality-plugin'), $plural_name),
            'most_used' => 'Most Used',
            /* translators: %s: plural taxonomy name */
            'back_to_items' => sprintf(__('&larr; Back to %s', 'functionality-plugin'), $plural_name),
            /* translators: %s: singular taxonomy name to lower */
            'no_item'   => sprintf(__('No %s', 'functionality-plugin'), strtolower($singular_name)),
            /* translators: %s: singular taxonomy name to lower */
            'filter_by' => sprintf(__('Filter by %s', 'functionality-plugin'), strtolower($singular_name)),
        ];
    }
}
