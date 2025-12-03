# Programmer Portfolio Website

A modern, responsive portfolio website built with PHP, HTML, CSS, and JavaScript.

## Features

- **Fully Responsive Design** - Works seamlessly on desktop, tablet, and mobile devices
- **Modern UI/UX** - Clean, professional design with smooth animations
- **PHP Backend** - Dynamic content management through configuration file
- **Contact Form** - Functional contact form with validation
- **Mobile-First Approach** - Optimized for mobile devices
- **Smooth Scrolling** - Elegant navigation between sections
- **Project Showcase** - Beautiful grid layout for displaying your work
- **Skills Section** - Organized display of technical skills
- **Social Media Integration** - Links to your professional profiles

## Structure

```
Portfolio/
├── index.php           # Main portfolio page
├── config.php          # Configuration and content management
├── contact.php         # Contact form handler
├── README.md           # This file
└── assets/
    ├── css/
    │   └── style.css   # All styles and responsive design
    ├── js/
    │   └── script.js   # Interactive features and animations
    └── images/         # Your images (create this folder)
```

## Setup Instructions

### 1. Basic Setup

1. Place all files in your web server directory (e.g., `c:\laragon\www\Portfolio`)
2. Make sure PHP is installed and running (PHP 7.4 or higher recommended)
3. Create the `assets/images/` directory for your images

### 2. Customize Content

Edit `config.php` to personalize your portfolio:

- **Personal Information**: Name, title, contact details
- **About Section**: Your description and resume link
- **Skills**: Add your technical skills by category
- **Projects**: Showcase your work with descriptions and links
- **Social Links**: Add your GitHub, LinkedIn, Twitter, etc.

### 3. Add Your Images

Place the following images in the `assets/images/` folder:
- `profile.jpg` - Your profile photo (optional)
- `project1.jpg`, `project2.jpg`, etc. - Project screenshots
- Or use placeholder images (currently configured)

### 4. Configure Contact Form

Edit `contact.php` and choose one of these options:

**Option 1: Email** (Default)
```php
$to = 'your-email@example.com'; // Change to your email
```

**Option 2: Database**
- Uncomment the database section
- Configure your database connection
- Create the messages table:
```sql
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    subject VARCHAR(200),
    message TEXT,
    created_at TIMESTAMP
);
```

**Option 3: File Storage** (for testing)
- Uncomment the file storage section
- Messages will be saved to `messages.txt`

### 5. Test Your Website

1. Start your web server (Laragon, XAMPP, WAMP, etc.)
2. Navigate to `http://localhost/Portfolio/`
3. Test all features:
   - Mobile menu toggle
   - Navigation links
   - Contact form
   - Responsive design (resize browser)

## Customization

### Colors
Edit CSS variables in `assets/css/style.css`:
```css
:root {
    --primary-color: #2563eb;
    --secondary-color: #1e40af;
    /* ... more colors */
}
```

### Sections
Add or remove sections by editing `index.php` and updating the navigation menu accordingly.

### Animations
Customize animations and transitions in `assets/js/script.js`.

## Browser Compatibility

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Technologies Used

- **PHP** - Server-side logic and dynamic content
- **HTML5** - Semantic markup
- **CSS3** - Styling and responsive design
- **JavaScript** - Interactivity and animations
- **Font Awesome** - Icons

## Mobile Responsive Features

- Hamburger menu for mobile navigation
- Touch-friendly buttons and links
- Optimized images and layouts
- Flexible grid systems
- Breakpoints at 768px and 480px

## License

Free to use for personal and commercial projects.

## Support

For issues or questions:
1. Check the configuration in `config.php`
2. Verify your web server is running
3. Check browser console for JavaScript errors
4. Ensure PHP error reporting is enabled for debugging

## Tips

- Use high-quality images for best results
- Keep project descriptions concise and impactful
- Update your skills regularly
- Test on actual mobile devices, not just browser dev tools
- Optimize images for web (compress before uploading)

Enjoy your new portfolio website! 🚀
