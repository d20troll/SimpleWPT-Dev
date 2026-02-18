# Clean Modern Theme

A clean, modern WordPress theme with block editor support and Advanced Custom Fields (ACF) integration. Perfect for blogs and custom post types.

## Features

- ✅ **Classic Theme with Block Editor Support** - Traditional PHP templates with full Gutenberg block editor integration
- ✅ **Custom Color Palette** - Defined in theme.json, no user color customization
- ✅ **ACF Ready** - Built-in support for Advanced Custom Fields
- ✅ **Custom Post Types Support** - Example portfolio post type included (commented out)
- ✅ **Responsive Design** - Mobile-first, fully responsive layout
- ✅ **Performance Optimized** - Minimal CSS/JS, system fonts, fast loading
- ✅ **SEO Friendly** - Semantic HTML5 markup
- ✅ **Accessibility Ready** - WCAG compliant structure

## Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher
- Advanced Custom Fields (recommended)

## Installation

### Method 1: Direct Upload

1. Download or clone this repository
2. ZIP the `clean-modern-theme` folder
3. Go to WordPress Admin → Appearance → Themes → Add New
4. Click "Upload Theme" and select the ZIP file
5. Click "Install Now" and then "Activate"

### Method 2: Manual Installation

1. Download or clone this repository
2. Upload the `clean-modern-theme` folder to `/wp-content/themes/`
3. Go to WordPress Admin → Appearance → Themes
4. Find "Clean Modern Theme" and click "Activate"

## Setup

### 1. Configure Menus

1. Go to Appearance → Menus
2. Create a new menu
3. Assign it to "Primary Menu" location
4. (Optional) Create a footer menu and assign to "Footer Menu"

### 2. Set Up Reading Settings

1. Go to Settings → Reading
2. Select "A static page" for homepage
3. Choose your homepage and blog page

### 3. Install Advanced Custom Fields (Recommended)

```bash
# Via WordPress Admin
Plugins → Add New → Search for "Advanced Custom Fields" → Install & Activate

# Or via Composer
composer require wpackagist-plugin/advanced-custom-fields
```

### 4. Configure Custom Logo (Optional)

1. Go to Appearance → Customize → Site Identity
2. Upload your logo (recommended size: 400x100px)

## Theme Configuration

### Color Palette

The theme includes a custom color palette defined in `theme.json`:

- **Primary**: `#2563eb` (Blue)
- **Secondary**: `#7c3aed` (Purple)
- **Accent**: `#f59e0b` (Amber)
- **Dark**: `#1f2937` (Dark Gray)
- **Gray**: `#6b7280` (Medium Gray)
- **Light Gray**: `#f3f4f6` (Light Gray)
- **White**: `#ffffff`

These colors are used throughout the block editor and frontend. Custom colors are disabled.

### Font Sizes

Defined font sizes:
- Small: 0.875rem
- Normal: 1rem
- Medium: 1.25rem
- Large: 1.75rem
- Extra Large: 2.5rem

### Spacing Scale

- XS: 0.5rem
- Small: 1rem
- Medium: 1.5rem
- Large: 2rem
- Extra Large: 3rem

## Custom Post Types

The theme includes an example Portfolio custom post type (commented out by default).

### To Enable Portfolio Post Type:

1. Open `functions.php`
2. Find the `clean_modern_theme_register_post_types()` function
3. Uncomment the `register_post_type()` line
4. Uncomment the taxonomy registration in `clean_modern_theme_register_taxonomies()`
5. Go to Settings → Permalinks and click "Save Changes" to flush rewrite rules

### Creating Custom Post Types with ACF:

1. Install ACF Pro (includes CPT UI)
2. Go to ACF → Post Types → Add New
3. Configure your custom post type
4. The theme will automatically support it

## Using Advanced Custom Fields

### Example: Adding Custom Fields to Posts

```php
<?php
// In single.php or your template
if ( function_exists( 'get_field' ) ) {
    $custom_field = get_field( 'field_name' );
    if ( $custom_field ) {
        echo esc_html( $custom_field );
    }
}
?>
```

### Example: ACF Repeater in Template

```php
<?php
if ( have_rows( 'repeater_field' ) ) :
    while ( have_rows( 'repeater_field' ) ) : the_row();
        $sub_value = get_sub_field( 'sub_field' );
        echo esc_html( $sub_value );
    endwhile;
endif;
?>
```

### Theme Options Page (Optional)

To enable a theme options page:

1. Open `functions.php`
2. Uncomment the ACF options page code block
3. Configure fields in ACF → Field Groups

## Customization

### Modifying Colors

Edit colors in two places:

1. **CSS Variables** (`style.css`):
```css
:root {
  --color-primary: #2563eb;
  --color-secondary: #7c3aed;
  /* etc. */
}
```

2. **Block Editor** (`theme.json`):
```json
"palette": [
  {
    "slug": "primary",
    "color": "#2563eb",
    "name": "Primary"
  }
]
```

### Adding Custom Templates

Create a new file in the theme root:

```php
<?php
/**
 * Template Name: Custom Template
 */

get_header();
// Your custom template code
get_footer();
?>
```

### Custom Widget Areas (Sidebars)

The theme doesn't include sidebars by default, but you can add them:

1. Add to `functions.php`:
```php
function clean_modern_theme_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'clean-modern-theme' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'clean_modern_theme_widgets_init' );
```

2. Display in templates:
```php
<?php
if ( is_active_sidebar( 'sidebar-1' ) ) {
    dynamic_sidebar( 'sidebar-1' );
}
?>
```

## File Structure

```
clean-modern-theme/
├── style.css              # Main stylesheet with theme header
├── functions.php          # Theme functions and setup
├── theme.json            # Block editor configuration
├── header.php            # Header template
├── footer.php            # Footer template
├── index.php             # Main template (blog)
├── single.php            # Single post template
├── page.php              # Page template
├── archive.php           # Archive template
├── search.php            # Search results template
├── 404.php               # 404 error page
├── comments.php          # Comments template
├── searchform.php        # Search form template
├── js/
│   └── navigation.js     # Mobile menu & navigation
└── README.md             # This file
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance Tips

1. **Use WebP images** - Convert images to WebP format for better performance
2. **Lazy load images** - WordPress natively supports lazy loading
3. **Use a caching plugin** - WP Rocket, W3 Total Cache, or WP Super Cache
4. **Optimize database** - Use WP-Optimize or similar
5. **Use a CDN** - Cloudflare or similar for static assets

## ACF Integration Tips

### Best Practices:

1. **Create Field Groups** - Organize fields by post type or page template
2. **Use ACF Blocks** - Create custom Gutenberg blocks with ACF
3. **Export/Import Fields** - Use ACF's sync feature for version control
4. **Conditional Logic** - Show/hide fields based on conditions

### Example ACF Block:

```php
// In functions.php
acf_register_block_type( array(
    'name'            => 'testimonial',
    'title'           => __( 'Testimonial' ),
    'render_template' => 'blocks/testimonial.php',
    'category'        => 'formatting',
    'icon'            => 'admin-comments',
) );
```

## Troubleshooting

### Menu Not Showing
- Make sure you've created a menu in Appearance → Menus
- Assign the menu to "Primary Menu" location

### Custom Post Type Not Appearing
- Uncomment the registration code in `functions.php`
- Go to Settings → Permalinks and save (flushes rewrite rules)

### Blocks Not Using Theme Colors
- Clear browser cache and WordPress cache
- Regenerate CSS in Gutenberg settings

### ACF Fields Not Saving
- Check PHP memory limit (increase to 256M)
- Disable conflicting plugins temporarily
- Check error logs for PHP errors

## Support

For issues, questions, or contributions:
- Check the code comments in each file
- Review WordPress Codex for template hierarchy
- Consult ACF documentation for field types

## License

This theme is licensed under the GNU General Public License v2 or later.
http://www.gnu.org/licenses/gpl-2.0.html

## Credits

- Built with WordPress best practices
- Uses system fonts for performance
- Designed for ACF integration
- Block editor color palette configuration

## Changelog

### Version 1.0.0
- Initial release
- Classic theme with block editor support
- Custom color palette in theme.json
- ACF integration ready
- Example custom post type
- Mobile-responsive design
- Clean, modern aesthetic
