# Gift Real Estate - Ethiopia

## Overview

Gift Real Estate is a property listing platform designed for the Ethiopian real estate market. The application follows a service-oriented architecture with three distinct components: a public-facing frontend for property browsing, a headless PHP backend API for data management, and an admin panel for property management.

The platform supports property listings for apartments, villas, and commercial properties across Ethiopian locations (CMC, Bole, Ayat, etc.) with features for searching, filtering, user inquiries, and agent management.

## User Preferences

Preferred communication style: Simple, everyday language.

## System Architecture

### Three-Tier Separation

The application is structured into three independent components that communicate via API:

1. **Frontend (Public Website)** - Static HTML/CSS/JavaScript application that consumes the backend API. Uses Tailwind CSS for styling and fetch() for API communication. Located in `/frontend`.

2. **Backend (Headless PHP API)** - Core PHP application serving JSON responses. Handles database operations, authentication, and business logic. No HTML rendering occurs here.

3. **Admin Panel** - Restricted dashboard for site management. Has its own UI but shares the same backend API for data operations. Located in `/admin`.

### Design Patterns

- **Headless Architecture**: Backend serves pure JSON data, allowing frontend flexibility
- **API-First Approach**: All data access goes through defined API endpoints
- **Role-Based Access**: Separate flows for regular users, agents, and administrators

### Core Functional Modules

| Module | Purpose |
|--------|---------|
| Property Management | CRUD for listings with types (Apartment, Villa, Commercial) and statuses (For Sale, Rent, Reduced) |
| Search & Filtering | Filter by price, bedrooms, area, amenities, and location tags |
| User/Agent Roles | Differentiated authentication for users (favorites) and agents (listing management) |
| Lead System | Inquiry forms that route to admin dashboard |

### Frontend Technology

- HTML5 with Tailwind CSS (via CDN)
- Vanilla JavaScript for API consumption
- Responsive grid layout for property cards
- Brand colors: Green (#004d40) and Yellow (#fdd835)

### Backend Technology

- Core PHP with custom routing (`router.php`)
- RESTful API endpoints (e.g., `/api/properties`, `/api/login`)
- JWT authentication for stateless session management
- File upload handling for property images

## External Dependencies

### Database

- **MySQL** - Primary data store
- Required tables: `users`, `properties`, `images`, `inquiries`
- Schema should be defined in `db.sql`

### Frontend Libraries

- **Tailwind CSS** (CDN) - Utility-first CSS framework for styling

### Authentication

- **JWT (JSON Web Tokens)** - Stateless authentication for admin and user sessions

### File Storage

- Local `uploads/` directory for property images
- PHP file upload handling required