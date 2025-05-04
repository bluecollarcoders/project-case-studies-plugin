# 🧩 Project Case Studies – Timeline Slider Block

A custom WordPress block built with the Block Editor that displays a horizontal timeline-style slider using [Slick.js](https://kenwheeler.github.io/slick/). Designed to showcase project milestones or steps visually.

---

## 📦 Features

- Uses [Slick.js](https://kenwheeler.github.io/slick/) for responsive sliding functionality.
- Built with static `save.js` output (no PHP rendering required).
- Clean markup & minimal styling (easy to override).
- Fully Gutenberg-compatible with modern block development practices.

---

## 🚀 Installation

1. Clone or download the plugin into your WordPress `wp-content/plugins` directory:

   ```bash
   git clone https://github.com/YOUR-USERNAME/project-case-studies.git
   ```

2. Install dependencies and build assets:

   ```bash
   npm install
   npm run build
   ```

3. Activate the plugin in WordPress Admin under **Plugins > Installed Plugins**.

---

## 🛠️ How to Use

1. In the WordPress Block Editor, open a post or custom post type like **Project**.
2. Search for the block named `Project Timeline Slider`.
3. Add it to your page.
4. Fill out the block’s sidebar fields (titles, descriptions, images) for each timeline card.
5. Publish or preview — the slider will be styled and interactive thanks to Slick.js.

---

## 🌐 Using in Other Themes

You can use this plugin in any WordPress theme — block-based.


### Optional: Override Styles

1. Add custom CSS targeting `.timeline-slider` and `.slick-*` classes in your theme.
2. Dequeue the plugin styles and enqueue your custom ones if needed.

---

## 💻 Development

- Built with:
  - `@wordpress/scripts`
  - React JSX syntax
  - ESNext
  - SCSS support

### Folder structure

```
project-case-studies/
├── blocks/
│   └── timeline-slider/
│       ├── block.json
│       ├── edit.js
│       ├── save.js
│       ├── index.js
│       └── style.css
├── includes/
├── build/
└── plugin-loader.php
```

---

## 🧹 To-Do

- [ ] Add animation settings (e.g., speed, autoplay toggle).
- [ ] Allow dynamic number of cards (currently fixed).
- [ ] Theme support hooks.
