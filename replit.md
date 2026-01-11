# Gift Real Estate - Ethiopia

## Overview

Gift Real Estate is a property listing platform designed for the Ethiopian real estate market. The application follows a service-oriented architecture with three distinct components: a public-facing frontend for property browsing, a headless PHP backend API for data management, and an admin panel for property management.

The platform supports property listings for apartments, villas, and commercial properties across Ethiopian locations (CMC, Bole, Ayat, etc.) with features for searching, filtering, user inquiries, and agent management.

## Recent Changes

### January 2026
- **SEO Optimization**: Implemented comprehensive SEO for all public routes.
  - Added dynamic metadata (titles, descriptions, keywords) targeting "Real Estate Property Addis Ababa" and "Gift Real Estate Legehar".
  - Implemented JSON-LD Schema markup for Organization, AboutPage, ImageGallery, ItemList, and RealEstateListing.
  - Configured dynamic `sitemap.xml` and `robots.txt` for better search engine indexing.
- **Amenities Management**: Enhanced property management with a multi-select amenities system.
  - Properties now store amenities as a JSON array in the database.
  - Admin panel updated with checkbox-based amenities selection.
  - Property detail pages dynamically display amenities with representative icons.
- **Contact System**: Improved contact page with dynamic settings integration and WhatsApp inquiry redirection.

## User Preferences

Preferred communication style: Simple, everyday language.

## System Architecture

### Three-Tier Separation

The application is structured into three independent components that communicate via API:

1. **Frontend (Public Website)** - Static HTML/CSS/JavaScript application that consumes the backend API. Uses Tailwind CSS for styling and fetch() for API communication. Located in `/frontend`.

2. **Backend (Headless PHP API)** - Core PHP application serving JSON responses. Handles database operations, authentication, and business logic. No HTML rendering occurs here.

3. **Admin Panel** - Restricted dashboard for site management. Has its own UI but shares the same backend API for data operations. Located in `/admin`.

### Core Functional Modules

| Module | Purpose |
|--------|---------|
| Property Management | CRUD for listings with types (Apartment, Villa, Commercial) and statuses (For Sale, Rent, Reduced) |
| Search & Filtering | Filter by price, bedrooms, area, amenities, and location tags |
| User/Agent Roles | Differentiated authentication for users (favorites) and agents (listing management) |
| Lead System | Inquiry forms that route to admin dashboard and WhatsApp |

### Technology Stack

- **Frontend**: HTML5, Tailwind CSS (CDN), Vanilla JavaScript
- **Backend**: PHP (Core), Custom Routing (`router.php`)
- **Database**: PostgreSQL (Replit Database)
- **Authentication**: JWT (JSON Web Tokens)
- **Storage**: Local `uploads/` directory for images

## External Dependencies

### Database

- **PostgreSQL** - Primary data store
- Schema defined in `db.sql`

### Frontend Libraries

- **Tailwind CSS** (CDN) - Styling
- **Font Awesome** - Icons

### Authentication

- **JWT** - Stateless session management

### File Storage

- Local `uploads/` directory with PHP file upload handling
