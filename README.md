# Songs Plugin

## Description
This is a simple plugin with custom post type Songs and Taxonomy Genres. It allows us to create a custom post type for songs and assign them to different genres. The plugin also includes a custom REST API endpoint which can be accessed by authors to submit song suggestions. The plugin can be installed via Composer.

## Features
- Custom post type 'Songs' - allows us to create and manage songs (accessible only to 'Admin' users)
- Custom taxonomy 'Genre' - allows us to categorize songs into different genres (accessible only to 'Admin' users)
- Shortcode to display HTML form for song suggestions - allows 'Authors' to add song suggestions form to their content
- Custom REST API endpoint for song suggestions - allows users to submit song suggestions via a form
- Form submission creates a new post in the 'Songs' custom post type with the submitted data.

## Installation via Composer
1. **Prerequisites**  
   - PHP ≥ 8.0
   - Composer installed globally  
   - A WordPress project managed by Composer (e.g. Bedrock or WP‑Core via Composer)

2. **Add the repository**  
   In our project’s `composer.json`, under the root:
   ```json
    "repositories": [
        {
        "type": "vcs",
        "url": "https://github.com/udit710/songs-plugin"
        }
    ]
   ```
   Ensure the `composer.json` file accepts dev versions. If not, we can enable it by adding the following settings to `composer.json`:
   ```json
    "minimum-stability": "dev",
    "prefer-stable": true
   ```
   This will allow us to install the plugin from the `dev-main` branch while still preferring stable versions.
3. **Require the plugin**
    Run the following command in your terminal:
    ```bash
    composer require udit710/songs-plugin:dev-main
    ```

4. **Activate the plugin**
    
    After installing the plugin, go to the WordPress admin panel, navigate to the 'Plugins' section, and activate the 'Songs Plugin'.

## Usage
1. After activating the plugin, we will see a new menu item called 'Songs' in the WordPress admin panel.
2. We can create new songs and assign them to the 'Genre' taxonomy.
3. To display the song suggestion form, use the shortcode `[song_suggestion_form]` in any post or page having the author as any user with the 'Author' role.
4. Song suggestions can be submitted via the form, which will create a new post in the 'Songs' custom post type with the submitted data.
5. The form includes fields for 'Name', 'Email', 'Song Name', and an optional field 'Song Description'.
6. The submitted data will be displayed in the 'Songs' custom post type as a post with status 'Pending Review'.
7. The post 'title' is set to the 'Name' and the rest of the fields in the form ('Email', 'Song Name', 'Song Description') are in the post 'excerpt'.

## Considerations
- Task 1:
    - CPT 'Songs' is created with the custom capability type set to 'song' and 'songs' respectively.
    - Display names are set to 'Songs' and 'Genre' as specified, and the registered names are 'sp_songs' and 'sp_genre' for consistent naming conventions.
    - All functions are prefixed with 'sp_' to avoid conflicts and keep consistent naming conventions.
    - The custom post type and taxonomy are registered with the 'admin' capability type, meaning only users with the 'administrator' role can access them.

- Task 2:
    - The form is accessble to all users.
    - The shortcode is restricted to content owned by any user with the 'Author' role, for any non-'Author' owned content, it displays a 'Access Denied' message.

## References

- Task 1:
    - [WordPress Plugin Documentation](https://developer.wordpress.org/plugins/) - For plugin boilerplate and best practices.
    - [Labels for CPTs and Taxonomy](https://wordpress.stackexchange.com/questions/5308/custom-post-types-taxonomies-and-permalinks) - To understand all capabilities and labels for custom post types and taxonomies.
    - [WordPress Codex](https://codex.wordpress.org/Function_Reference/register_post_type) - To get parameters for register_post_type.
    - [WordPress Codex](https://codex.wordpress.org/Function_Reference/register_taxonomy) - To get parameters for register_taxonomy.
    - [Configuring capabilities](https://learn.wordpress.org/tutorial/custom-post-types-and-capabilities/) - To understand how to configure capabilities for custom post types and taxonomies specific to my use case.
    - [Roles and Capabilities](https://kinsta.com/blog/wordpress-user-roles/) - To configure permissions for custom post types and taxonomies and restrict access to administrator role only.
    - AI Tools (ChatGPT):
        - For formatting the code and README.md file.
        - For syntax corrections.

- Task 2:
    - [WordPress Shortcode API](https://codex.wordpress.org/Shortcode_API) - To get shortcode boilerplate.
    - [Shortcode not working](https://wordpress.stackexchange.com/questions/160362/wordpress-plugin-shortcode-not-working) - Shortcode causing error due to incorrect JavaScript, fixed.
    - [WP Beginner Docs](https://www.wpbeginner.com/wp-tutorials/how-to-fix-the-invalid-json-error-in-wordpress-beginners-guide/) - To fix the invalid JSON error in WordPress Posts, fixed by re-setting permalinks.
    - [Retrieve Post Body](https://developer.wordpress.org/reference/functions/wp_remote_retrieve_body/) - To retrieve post data.
    - [REST API Docs](https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-rest-api-support-for-custom-content-types/) - To add REST API support for custom content types.
    - [WP Insert Post](https://developer.wordpress.org/reference/functions/wp_insert_post/) - To convert form data to custom post data.
    - [Composer Docs](https://getcomposer.org/doc/) - For basic composer.json structure.
    - [Composer VCS Docs](https://getcomposer.org/doc/05-repositories.md#vcs) - To make the plugin installable via Composer from GitHub.