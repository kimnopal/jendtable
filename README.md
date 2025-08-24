# JendTable

A modern, responsive Laravel Livewire table component with search, pagination, and sorting capabilities built with DaisyUI.

## Features

-   🔍 **Real-time Search** - Search across multiple columns with debounced input
-   📄 **Pagination** - Customizable pagination with multiple per-page options
-   🎨 **DaisyUI Styling** - Beautiful, responsive design with DaisyUI components
-   ⚡ **Livewire Powered** - Real-time updates without page refresh
-   🔧 **Highly Configurable** - Flexible column configuration and validation
-   📱 **Mobile Responsive** - Works perfectly on all device sizes
-   🎯 **Type Safe** - Built with proper validation and error handling

## Installation

You can install the package via Composer:

```bash
composer require kimnopal/jendtable
```

## Requirements

-   PHP 8.1 or higher
-   Laravel 10.0 or 11.0
-   Livewire 3.6 or higher
-   TailwindCSS with DaisyUI

## Usage

### Basic Usage

```blade
<livewire:jendtable:table
    :model="\App\Models\Product::class"
    :columns="[
        ['label' => 'Name', 'key' => 'name', 'searchable' => true],
        ['label' => 'Price', 'key' => 'price', 'sortable' => true],
        ['label' => 'Stock', 'key' => 'stock'],
        ['label' => 'Description', 'key' => 'description', 'searchable' => true],
    ]"
/>
```

### Advanced Configuration

```blade
<livewire:jendtable:table
    :model="\App\Models\Product::class"
    :columns="[
        ['label' => 'Name', 'key' => 'name', 'searchable' => true, 'sortable' => true],
        ['label' => 'Price', 'key' => 'price', 'searchable' => false, 'sortable' => true],
        ['label' => 'Stock', 'key' => 'stock', 'searchable' => false, 'sortable' => true],
        ['label' => 'Description', 'key' => 'description', 'searchable' => true, 'sortable' => false],
    ]"
    :pagination="[
        'enabled' => true,
        'perPage' => 10,
        'perPageOptions' => [5, 10, 25, 50]
    ]"
/>
```

## Column Configuration

Each column supports the following options:

| Option       | Type    | Default  | Description                             |
| ------------ | ------- | -------- | --------------------------------------- |
| `label`      | string  | required | Display name for the column header      |
| `key`        | string  | required | Database column name or model attribute |
| `searchable` | boolean | true     | Whether the column is searchable        |
| `sortable`   | boolean | true     | Whether the column is sortable          |

## Pagination Configuration

| Option           | Type    | Default     | Description                      |
| ---------------- | ------- | ----------- | -------------------------------- |
| `enabled`        | boolean | true        | Enable/disable pagination        |
| `perPage`        | integer | 10          | Default number of items per page |
| `perPageOptions` | array   | [5, 10, 20] | Available per-page options       |

## Styling

This package uses DaisyUI components. Make sure you have DaisyUI installed and configured in your TailwindCSS setup:

```bash
npm install daisyui
```

Add DaisyUI to your `tailwind.config.js`:

```javascript
module.exports = {
    plugins: [require("daisyui")],
};
```

## Customization

### Custom Pagination View

You can customize the pagination view by publishing the views:

```bash
php artisan vendor:publish --tag=jendtable-views
```

### Custom Table View

The table view can be customized by modifying the published views in `resources/views/vendor/jendtable/`.

## Validation

The component includes built-in validation for:

-   Model class existence and inheritance
-   Column configuration (required fields, data types)
-   Pagination settings (valid ranges, types)

## Error Handling

All configuration errors are caught and displayed with helpful error messages to assist in debugging.

## Examples

### Product Listing

```blade
<livewire:jendtable:table
    :model="\App\Models\Product::class"
    :columns="[
        ['label' => 'ID', 'key' => 'id', 'searchable' => false, 'sortable' => true],
        ['label' => 'Product Name', 'key' => 'name', 'searchable' => true],
        ['label' => 'Category', 'key' => 'category', 'searchable' => true],
        ['label' => 'Price', 'key' => 'price', 'searchable' => false, 'sortable' => true],
        ['label' => 'Stock', 'key' => 'stock', 'sortable' => true],
        ['label' => 'Status', 'key' => 'status', 'searchable' => true],
    ]"
    :pagination="[
        'enabled' => true,
        'perPage' => 15,
        'perPageOptions' => [10, 15, 25, 50, 100]
    ]"
/>
```

### User Management

```blade
<livewire:jendtable:table
    :model="\App\Models\User::class"
    :columns="[
        ['label' => 'Name', 'key' => 'name', 'searchable' => true],
        ['label' => 'Email', 'key' => 'email', 'searchable' => true],
        ['label' => 'Role', 'key' => 'role', 'searchable' => true, 'sortable' => false],
        ['label' => 'Created', 'key' => 'created_at', 'searchable' => false, 'sortable' => true],
    ]"
/>
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support

If you discover any security vulnerabilities or bugs, please create an issue on GitHub.

## Credits

-   [kimnopal](https://github.com/kimnopal)
-   [All Contributors](../../contributors)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.
