# Testing Strategy for Songs Plugin

## Table of Contents
- [Overview](#overview)
- [Features to Test](#features-to-test)
  - [1. Custom Post Type Registration](#1-custom-post-type-registration)
  - [2. Taxonomy Registration & Default Term](#2-taxonomy-registration--default-term)
  - [3. Capability Syncing](#3-capability-syncing)
  - [4. Shortcode Rendering Logic](#4-shortcode-rendering-logic)
  - [5. REST Endpoint](#5-rest-endpoint)
- [Sample PHPUnit Test Names](#sample-phpunit-test-names)
- [Tools & Approach](#tools--approach)

## Overview
This document outlines the testing strategy for the Songs Plugin, focusing on unit tests, API tests, and manual testing. The goal is to ensure that all features work as expected and that the plugin integrates well with WordPress.

## Features to Test

### 1. Custom Post Type Registration

**Tests**
- `songs_cpt` exists after `init`.
- Uses correct capabilities mapping.
- `songs_cpt` is not publicly queryable.

**Key functions to test**
- `sp_register_songs_custom_post_type()`

### 2. Taxonomy Registration & Default Term
Verifies that 'Genre' is registered and seeded correctly.

**Tests**
- `song_genre` taxonomy exists.
- Default term 'Classical' is present.

**Key functions to test**
- `sp_register_genre_taxonomy()`
- `activate()`

### 3. Capability Syncing

**Tests**
- Administrator role has all song‑related caps Only administrators can manage songs.

**Key functions to test**
- `songs_plugin_sync_caps()`

### 4. Shortcode Rendering Logic

This test verifies that only authors can *insert* the HTML form, but everyone can see it on the front end.

**Tests**
- `[song-suggestion-form]` shortcode returns form HTML when the *post’s author* is an 'author'.
- Returns 'Access Denied' message when the *post’s author* is not an 'author'.
  
**Key functions to test**
- `sp_render_form()`

### 5. REST Endpoint
This test verifies that the REST endpoint is registered and that it handles requests correctly.

**Tests**
- Route `/songs/v1/send-suggestions` is registered on `rest_api_init`.
- Permission callback allows only valid requests (e.g. nonce or capability check).
- Handler returns expected JSON on success/failure.

**Key functions to test**
- `sp_register_rest_api()`
- `sp_handle_song_suggestion_form()`

## Sample PHPUnit Test Names

- `test_register_songs_custom_post_type()`
- `test_default_genre_term_exists()`
- `test_admin_role_has_song_caps()`
- `test_author_shortcode_renders_form()`
- `test_rest_endpoint_registration()`
- `test_rest_endpoint_callback_behavior()`

## Tools & Approach

- **Unit Tests** (PHPUnit) for all features above.
- **API Tests** (Postman) for the REST endpoint.
- **Manual Smoke Tests** to:
    - check installation via Composer
    - activate plugin 
    - create a 'Songs' post 
    - assign 'Genre'
    - add shortcode to an author’s post
    - submit form from webpage (frontend).