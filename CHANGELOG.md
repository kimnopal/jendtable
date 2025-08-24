# Changelog

All notable changes to `kimnopal/jendtable` will be documented in this file.

## [1.0.0] - 2025-08-25

### Added

-   Initial release of JendTable
-   Real-time search functionality across multiple columns
-   Customizable pagination with per-page options
-   Column sorting capabilities
-   DaisyUI styling integration
-   Livewire 3.6 compatibility
-   Model validation and error handling
-   Responsive design for mobile and desktop
-   Configurable column properties (searchable, sortable)
-   Custom pagination view support
-   Comprehensive documentation and examples

### Features

-   ✨ Search with debounced input (300ms)
-   📄 Pagination with customizable per-page options
-   🔄 Column sorting (ascending/descending)
-   🎨 Beautiful DaisyUI styling
-   📱 Mobile-responsive design
-   ⚡ Real-time updates with Livewire
-   🔧 Flexible configuration options
-   🛡️ Built-in validation and error handling

### Dependencies

-   PHP ^8.1
-   Laravel ^10.0|^11.0
-   Livewire ^3.6
-   DaisyUI (for styling)

### Breaking Changes

-   None (initial release)

### Deprecated

-   None (initial release)

### Removed

-   None (initial release)

### Fixed

-   None (initial release)

### Security

-   Input validation for all configuration parameters
-   XSS protection through Laravel's built-in escaping
-   CSRF protection via Livewire
