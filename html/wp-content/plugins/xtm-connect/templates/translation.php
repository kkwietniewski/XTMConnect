<?php
global $wpdb;
$results = $wpdb->get_results("SELECT * FROM wp_posts");

settings_errors();
?>

<form method="post" action="dirname(__FILE__) . '/' .a.php">
<?php
echo <<<TABLE
<div class="wp-list-table widefat fixed striped table-view-list">
    <table>
        <thead>
            <tr>
                <td id="cb" class="manage-column column-cb check-column">
                    <label class="screen-reader-text" for="cb-select-all-1">Select All
                    </label>
                    <input id="cb-select-all-1" type="checkbox">
                </td>
                <th>Id</th>
                <th>Title</th>
                <th>Content</th>
                <th>Status</th>
                <th>Type</th>
                <th>Modified</th>
            </tr>
        </thead>
        <tbody>
TABLE;
    foreach ($results as $row) {
        echo <<<ROW
        
            <tr>
                <th scope="row" class="check-column">
                    <label class="screen-reader-text" for="cb-select-$row->ID">
                    Select $row->post_title
                    </label>
                    <input id="cb-select-$row->ID" type="checkbox" name="post[]" value="$row->ID">
                </th>
                <td>$row->ID</td>
                <td>$row->post_title</td>
                <td>$row->post_content</td>
                <td>$row->post_status</td>
                <td>$row->post_type</td>
                <td>$row->post_modified</td>
            </tr>
        
ROW;
}
echo <<<FOOTER
        </tbody>
        <tfoot>
            <tr>
                <td id="cb" class="manage-column column-cb check-column">
                    <label class="screen-reader-text" for="cb-select-all-1">Select All
                    </label>
                    <input id="cb-select-all-1" type="checkbox">
                </td>
                <th>Id</th>
                <th>Title</th>
                <th>Content</th>
                <th>Status</th>
                <th>Type</th>
                <th>Modified</th>
            </tr>
        </tfoot>
    </table>
<div>
FOOTER;

submit_button("Translate");
?>
</form>