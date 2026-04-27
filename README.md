# Clean Pixel Modern UI - Laravel Portfolio 🚀

A highly optimized, modern, and cinematic portfolio website built with Laravel. This project features the **"H-PERF PIXEL UI"** aesthetic—a design system that blends clean minimalism with cyberpunk-inspired pixel UI, fluid 60FPS animations, and glassmorphism. 

Designed for ultra-smooth user experiences, it utilizes **GSAP** and **Lenis** to create a native app-like scroll feel, alongside a powerful centralized Admin Dashboard to manage every aspect of the portfolio dynamically.

---

## ✨ Key Features

### 🎨 Frontend (Guest Experience)
- **H-PERF PIXEL UI Design System:** A strict, premium UI identity utilizing tailwind-customized colors (`#f5f5f5` base, `#1e293b` text, and `#22d3ee` cyan neon glow accents).
- **Cinematic Liquid Loader:** A beautifully staggered, dual-layered water-fill animation loading screen utilizing CSS keyframes and `requestAnimationFrame`.
- **Interactive Matrix Particle Swarm:** Floating ambient pixel particles that react to cursor proximity using GSAP math distance repulsion physics.
- **Synchronized Smooth Scroll:** Lenis combined with GSAP ticker loop ensuring zero-jitter, 60fps scrolling and native scrubber translations.
- **Pixel Wave Theme Transition:** A high-performance Dark/Light mode toggle that sweeps across the screen in dynamic CSS blocks.
- **Global Lightbox System:** Instantly preview documentations and images on a single page directly via native overlay modal.
- **Gateway Security Checkpoint:** Mandatory reCAPTCHA verification gateway enforcing anti-spam policies globally. 

### 🔐 Backend (Admin System)
- **Comprehensive CMS Panel:** Manage Projects (with toggle publish & sort features), Skills, Certificates, Experiences, Activities, and Profile details.
- **Inbox Management:** Track and reply to contact messages sent securely via the frontend forms.
- **Rate-Limited Endpoints:** Form submissions and gateway verifications are throttled (`throttle:5,1`) to prevent abuse.

---

## 🛠️ Technology Stack

- **Backend:** Laravel 11/13 (PHP 8.3+)
- **Database:** MySQL 
- **Styling:** Tailwind CSS (with intricate custom JIT root variables)
- **Animations:** GSAP (GreenSock) & CSS Transitions
- **Scroll Engine:** @studio-freight/lenis
- **Security:** Google reCAPTCHA v2 API
- **Deployment Structure:** Laragon-ready, Composer, NPM for Vite bundling.

---

## 🚀 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/CleonThadeas/portofolio.git
   cd portofolio
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup:**
   Copy the `.env` example file and generate an application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure the Database & API Keys:**
   Update your `.env` file with your precise MySQL credentials, Mail server data, and Google reCAPTCHA keys:
   ```env
   DB_DATABASE=portofolioandry
   DB_USERNAME=root
   DB_PASSWORD=

   # reCAPTCHA config
   RECAPTCHA_SITE_KEY=your_site_key_here
   RECAPTCHA_SECRET_KEY=your_secret_key_here
   ```

5. **Migrate and Seed the Database:**
   ```bash
   php artisan migrate:fresh --seed
   ```
   *(The seeder generates an initial Admin user and sample portfolio data.)*

6. **Compile Frontend Assets:**
   ```bash
   npm run build
   # Or for development: npm run dev
   ```

7. **Run the Application:**
   ```bash
   php artisan serve
   ```

## 🔒 Security
- This project leverages strong password hashing (Bcrypt).
- The `GuestGateway` middleware protects frontend access using session state injection verified against Google `siteverify` servers.
- **If you are testing locally (`localhost`)**, please ensure you append `localhost` to your Google reCAPTCHA Admin Console supported domains to avoid key blocks.

---

*Designed and Developed passionately with 🩵 for a stunning web experience.*
