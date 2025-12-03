# Vercel Deployment Instructions

Your portfolio is now ready to deploy on Vercel!

## 📋 Prerequisites

1. Create a GitHub account (if you don't have one): https://github.com
2. Create a Vercel account: https://vercel.com (sign up with GitHub)

## 🚀 Deployment Steps

### Step 1: Push to GitHub

1. Open terminal in your portfolio folder
2. Run these commands:

```bash
cd c:\laragon\www\Portfolio
git init
git add .
git commit -m "Initial portfolio commit"
```

3. Create a new repository on GitHub: https://github.com/new
   - Name it: `portfolio`
   - Keep it public or private
   - Don't add README, .gitignore, or license

4. Connect and push:

```bash
git remote add origin https://github.com/YOUR-USERNAME/portfolio.git
git branch -M main
git push -u origin main
```

### Step 2: Deploy to Vercel

1. Go to https://vercel.com/new
2. Click "Import Git Repository"
3. Select your portfolio repository
4. Click "Deploy"

That's it! Vercel will automatically:
- Detect PHP files
- Build your project
- Deploy to a live URL (e.g., `portfolio.vercel.app`)

## 🔧 Important Files for Vercel

✅ `vercel.json` - Configuration file
✅ `api/contact.php` - Contact form API endpoint
✅ All other files work as-is

## ⚙️ Environment Variables (Optional)

If you want email functionality on Vercel:
1. Go to your Vercel project settings
2. Add environment variables:
   - `SMTP_USERNAME`: Your Gmail
   - `SMTP_PASSWORD`: Your App Password
   - `TO_EMAIL`: Yamamotokim4@gmail.com

## 📧 Note About Contact Form

Vercel doesn't support PHP's `mail()` function. Options:
1. Use FormSubmit.co (free, no setup)
2. Use SendGrid/Mailgun (free tier available)
3. Contact form will show success but won't send emails

## 🎯 Your Live URL

After deployment, you'll get:
- Free URL: `https://your-portfolio.vercel.app`
- Custom domain support available

## 🔄 Auto-Deploy

Every time you push to GitHub, Vercel automatically redeploys!

```bash
git add .
git commit -m "Update portfolio"
git push
```

## 📱 Features on Vercel

✅ Free HTTPS/SSL
✅ Global CDN
✅ Automatic deployments
✅ Preview deployments
✅ Custom domain support
✅ Analytics

Need help? Let me know! 🚀
