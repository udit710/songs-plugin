# Songs Plugin

## Description
This is a simple plugin with custom post type Songs and Taxonomy Genres. It allows you to create a custom post type for songs and assign them to different genres. The plugin also includes a custom REST API endpoint which can be accessed by authors to submit song suggestions.

## Features
- Custom post type for songs - allows you to create and manage songs (accessible only to admin users)
- Custom taxonomy for genres - allows you to categorize songs into different genres (accessible only to admin users)
- Shortcode to display HTML form for song suggestions - allows authors to submit song suggestions (accessible only to authors)
- Custom REST API endpoint for song suggestions - allows authors to submit song suggestions (accessible only to via the HTML form)

## References

- Task 1:
    - [WordPress Plugin Documentation](https://developer.wordpress.org/plugins/) - For plugin boilerplate and best practices.
    - [Labels for CPTs and Taxonomy](https://wordpress.stackexchange.com/questions/5308/custom-post-types-taxonomies-and-permalinks) - To understand all capabilities and labels for custom post types and taxonomies.
    - [WordPress Codex](https://codex.wordpress.org/Function_Reference/register_post_type) - To get parameters for register_post_type.
    - [WordPress Codex](https://codex.wordpress.org/Function_Reference/register_taxonomy) - To get parameters for register_taxonomy.
    - [Configuring capabilities](https://learn.wordpress.org/tutorial/custom-post-types-and-capabilities/) - To understand how to configure capabilities for custom post types and taxonomies specific to my use case.
    - [Roles and Capabilities](https://kinsta.com/blog/wordpress-user-roles/) - To configure permissions for custom post types and taxonomies and restrict access to administrator role only.
    - AI Tools (ChatGPT) 
        - For formatting the code and README.md file.
        - For syntax corrections.