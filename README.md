# 🧩 Project Case Studies Plugin

A comprehensive WordPress plugin for showcasing project case studies and portfolios. Built with modern WordPress block editor technology, this plugin provides custom post types, block patterns, templates, and interactive components to create professional project showcases.

---

## 📦 Features

### Core Functionality
- **Custom Post Type**: `project` with full WordPress integration
- **Custom Taxonomy**: `business_type` for categorizing projects
- **Block Templates**: Pre-designed layouts for project pages
- **Block Patterns**: Ready-to-use content patterns for case studies
- **Timeline Slider Block**: Interactive project milestone display using Slick.js
- **Editor Enhancements**: Custom components and tools for the block editor

### Technical Features
- Built with modern WordPress block development practices
- Composer autoloading for organized PHP code
- React/JSX components with @wordpress/scripts
- Responsive design with mobile optimization
- SEO-friendly structure and markup

---

## 🚀 Installation

1. **Clone or download** the plugin into your WordPress `wp-content/plugins` directory:
   ```bash
   git clone https://github.com/YOUR-USERNAME/projects-case-studies.git
   ```

2. **Navigate to the plugin directory**:
   ```bash
   cd projects-case-studies
   ```

3. **Install PHP dependencies**:
   ```bash
   composer install
   ```

4. **Install JavaScript dependencies and build assets**:
   ```bash
   npm install
   npm run build
   ```

5. **Activate the plugin** in WordPress Admin under **Plugins > Installed Plugins**.

---

## 🛠️ How to Use the Plugin

### 1. Creating Project Case Studies

#### Adding New Projects
1. In your WordPress admin, navigate to **Projects > Add New**
2. You'll see the custom project post type with enhanced editing capabilities
3. Add your project title, content, and featured image
4. Assign **Business Types** (categories) to organize your projects
5. Use the available block patterns to structure your case study content

#### Project Content Structure
The plugin provides several pre-built patterns for consistent case study layouts:

- **Single Hero Pattern**: Eye-catching project introduction
- **Challenge Pattern**: Describe the problem you solved
- **Solution Pattern**: Explain your approach and methodology
- **Details Pattern**: Technical specifications and project details
- **Results Pattern**: Showcase outcomes and achievements
- **Testimonial Pattern**: Client feedback and quotes
- **Timeline Pattern**: Project milestones and timeline
- **Call to Action Pattern**: Next steps or contact information

### 2. Using Block Patterns

#### Accessing Patterns
1. In the block editor, click the **+** (Add Block) button
2. Go to the **Patterns** tab
3. Look for patterns prefixed with your plugin name
4. Click any pattern to insert it into your content

#### Available Patterns
- **Archive Hero**: Perfect for project listing pages
- **Single Hero**: Project page headers
- **Challenge**: Problem statement sections
- **Solution**: Methodology and approach
- **Details**: Technical specifications
- **Results**: Outcomes and metrics
- **Testimonial**: Client quotes
- **Timeline**: Project milestones
- **Call to Action**: Contact or next steps
- **Query Loop**: Display multiple projects

### 3. Timeline Slider Block

#### Adding the Timeline Slider
1. In the block editor, search for "Timeline Slider"
2. Add the block to your content
3. Configure timeline items in the block sidebar:
   - **Title**: Milestone name
   - **Description**: Detailed explanation
   - **Image**: Visual representation
   - **Date/Order**: Chronological sequence

#### Timeline Best Practices
- Use 3-7 timeline items for optimal display
- Keep descriptions roughly the same length
- Use consistent image dimensions (recommended: 400x300px)
- Arrange items chronologically

### 4. Managing Business Types (Categories)

#### Creating Business Type Categories
1. Go to **Projects > Business Types**
2. Add new categories like:
   - Web Development
   - Mobile Apps
   - E-commerce
   - Branding
   - Consulting
3. Assign projects to appropriate categories

#### Using Categories
- Filter projects by business type on archive pages
- Create targeted landing pages for specific services
- Improve site navigation and user experience

### 5. Template System

The plugin includes custom templates that automatically apply to:

#### Archive Template (`archive-project.html`)
- Displays all projects in a grid or list layout
- Includes filtering by business type
- Responsive design for all devices
- SEO-optimized structure

#### Single Project Template (`single-project.html`)
- Individual project page layout
- Optimized for case study presentation
- Includes related projects section
- Social sharing integration

#### Business Type Archive (`taxonomy-business_type.html`)
- Shows projects filtered by specific business type
- Custom header for each category
- Breadcrumb navigation

### 6. Editor Enhancements

The plugin adds custom components to enhance the editing experience:

- **Custom sidebar panels** for project-specific settings
- **Enhanced media handling** for project galleries
- **Specialized input fields** for case study data
- **Preview modes** for different device sizes

---

## 🎨 Customization

### Styling Your Projects

#### Theme Integration
The plugin works with any WordPress theme but provides its own styling:

```css
/* Override plugin styles in your theme */
.project-archive {
    /* Custom archive styling */
}

.single-project {
    /* Individual project page styling */
}

.timeline-slider {
    /* Timeline component styling */
}
```

#### Custom Templates
You can override plugin templates by copying them to your theme:

1. Copy templates from `/plugins/projects-case-studies/templates/`
2. Paste into your theme directory
3. Modify as needed - your theme versions will take precedence

### Adding Custom Fields

Extend projects with additional metadata:

```php
// Add to your theme's functions.php
add_action('add_meta_boxes', 'add_project_meta_boxes');
function add_project_meta_boxes() {
    add_meta_box(
        'project-details',
        'Project Details',
        'project_details_callback',
        'project'
    );
}
```

---

## 🌐 Use Cases

### Portfolio Websites
- Showcase your best work
- Organize projects by industry or service type
- Create compelling case studies that convert visitors

### Agency Websites
- Display client work with detailed case studies
- Use business types to organize by service offerings
- Include client testimonials and results

### Freelancer Portfolios
- Professional project presentation
- Timeline sliders for project phases
- Easy content management with patterns

### Corporate Websites
- Internal project documentation
- Success story showcases
- Department-specific project filtering

---

## 🔧 Development

### File Structure
```
projects-case-studies/
├── blocks/
│   └── timeline-slider/        # Timeline slider block
├── build/                      # Compiled assets
├── editor/
│   └── components/            # Custom editor components
├── includes/
│   ├── Admin/                 # Admin functionality
│   ├── Assets/                # Asset management
│   ├── Blocks/                # Block registration
│   ├── Meta/                  # Custom fields
│   ├── PostTypes/             # Custom post types
│   ├── RegisterPatterns/      # Pattern registration
│   ├── Taxonomies/            # Custom taxonomies
│   ├── Traits/                # Reusable PHP traits
│   ├── Loader.php             # Main plugin loader
│   └── Templates.php          # Template handling
├── patterns/                   # Block patterns (.html files)
├── templates/                  # Page templates (.html files)
├── vendor/                     # Composer dependencies
├── composer.json              # PHP dependencies
├── package.json               # JavaScript dependencies
├── plugin-loader.php          # Main plugin file
└── webpack.config.js          # Build configuration
```

### Development Commands

```bash
# Install dependencies
composer install
npm install

# Development build (watch mode)
npm run start

# Production build
npm run build

# Update Composer dependencies
composer update
```

### Extending the Plugin

#### Adding New Block Patterns
1. Create new `.html` files in the `/patterns/` directory
2. Register them in `/includes/RegisterPatterns/`
3. Follow WordPress block pattern standards

#### Creating Custom Blocks
1. Add new block directories under `/blocks/`
2. Register in `/includes/Blocks/`
3. Build with `npm run build`

---

## 🔧 Troubleshooting

### Common Issues

1. **Projects not showing**:
   - Ensure the plugin is activated
   - Check permalink settings (go to Settings > Permalinks and click "Save")
   - Clear any caching plugins

2. **Patterns not appearing**:
   - Verify pattern files exist in `/patterns/` directory
   - Check pattern registration in includes
   - Ensure proper WordPress permissions

3. **Timeline slider not working**:
   - Check browser console for JavaScript errors
   - Verify Slick.js is loading properly
   - Test with default theme to isolate conflicts

4. **Template issues**:
   - Check if theme is overriding plugin templates
   - Verify template files exist and have proper permissions
   - Test with a block-based theme

### Getting Help

- Check WordPress debug logs for PHP errors
- Use browser developer tools for JavaScript issues
- Test with default WordPress theme and no other plugins
- Ensure WordPress, PHP, and plugin versions are compatible

---

## 📋 Requirements

- **WordPress**: 5.9 or higher
- **PHP**: 7.4 or higher
- **Node.js**: 14 or higher (for development)
- **Composer**: Latest version (for development)

---

## 🧹 Roadmap

### Planned Features
- [ ] Advanced filtering options for project archives
- [ ] Integration with popular page builders
- [ ] Additional slider layouts (vertical, grid)
- [ ] Export/import functionality for projects
- [ ] Multi-language support (WPML/Polylang)
- [ ] Performance optimizations
- [ ] Accessibility improvements
- [ ] REST API endpoints for headless implementations

### Current Limitations
- Timeline slider has fixed number of items
- Limited animation customization options
- Requires manual pattern insertion

---

## 📄 License

This project is licensed under the GPL v2 or later - see the plugin header for details.

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

### Development Setup
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

---

## 👨‍💻 Author

**Caleb Matteis**
- Website: [https://calebmatteis.online](https://calebmatteis.online)
- Email: info@calebmatteis.online

---

*This plugin provides everything you need to create professional project case studies and portfolio websites with WordPress.*
