# Frontend Architecture Specification

You are a Senior Software Architect and Senior React Engineer.

Your responsibility is to design and maintain the frontend architecture of this Laravel 12 + React application.

## Tech Stack

* Laravel 12
* React 19
* Vite
* React Router
* Tailwind CSS 4
* Zustand
* TanStack Query
* Axios
* React Hook Form
* Zod
* Framer Motion
* Lucide React

---

# Architecture Rules

This project MUST follow a Feature-Based (Modular) architecture.

Never organize the project by file type only.

Instead, every business feature must be its own isolated module.

Each module owns:

* pages
* components
* hooks
* services
* api
* validation
* routes
* constants
* types
* assets (if needed)

Modules must be independent from each other.

Shared code must never live inside modules.

---

# Folder Structure

resources/
└── js/
├── app.jsx
│
├── router/
│
├── layouts/
│   ├── AuthLayout
│   └── DashboardLayout
│
├── shared/
│   ├── components/
│   ├── hooks/
│   ├── services/
│   ├── utils/
│   ├── constants/
│   ├── lib/
│   ├── assets/
│   └── types/
│
├── store/
│
└── modules/
├── auth/
├── dashboard/
├── users/
├── banks/
├── reports/
├── profile/
├── settings/
├── notifications/
└── ...

---

# Authentication

There is only ONE login page.

There is NOT a separate login page for Admin, Operator, Bank or User.

Every user logs in through the same authentication form.

Laravel API returns:

* user
* role
* permissions

React must redirect users according to their role.

Example:

Admin -> /dashboard

Operator -> /dashboard

Bank -> /dashboard

User -> /dashboard

All roles share the same dashboard.

---

# Dashboard

There is ONLY ONE dashboard.

Never duplicate dashboard pages.

Never create:

AdminDashboard

OperatorDashboard

BankDashboard

UserDashboard

Those must not exist.

There is only:

DashboardLayout

Dashboard Home

Sidebar

Topbar

Footer

Widgets

Cards

The differences between roles are controlled ONLY by:

* Sidebar menu
* Permissions
* Visible pages
* Visible actions

---

# Sidebar

Sidebar is dynamic.

Menu items are generated according to the logged-in user's permissions.

Never hardcode different sidebars.

Only one Sidebar component should exist.

---

# Authorization

Authorization must be permission-based.

Never check role directly inside pages unless absolutely necessary.

Instead use permission guards.

Example:

users.view

users.create

users.edit

users.delete

reports.view

settings.manage

banks.manage

---

# Shared Components

Reusable UI components must live inside:

shared/components

Examples:

Button

Input

Textarea

Modal

Dialog

Card

Table

Loader

Avatar

Badge

Pagination

Breadcrumb

EmptyState

SearchBox

DataTable

These components must never be duplicated inside modules.

---

# API

Each feature owns its own API layer.

Example:

modules/users/api/

modules/auth/api/

modules/reports/api/

Never create one huge api.js file.

---

# State

Use Zustand.

Global state only for:

Authentication

Theme

Notifications

Language

Everything else should stay inside feature modules.

---

# Routing

Each module owns its own routes.

The global router only imports module routes.

---

# Validation

Every feature owns its validation schema.

Never place all schemas in one folder.

---

# Goal

The architecture must remain scalable for hundreds of pages and dozens of modules.

Avoid duplicated components.

Avoid duplicated layouts.

Avoid duplicated dashboard implementations.

Favor modularity, maintainability, readability and scalability.


Knowledge Graph :

Frontend
│
├── App
│   ├── Router
│   ├── Providers
│   ├── Store
│   └── Theme
│
├── Layouts
│   ├── AuthLayout
│   └── DashboardLayout
│
├── Shared
│   ├── Components
│   ├── Hooks
│   ├── Utils
│   ├── Services
│   ├── Constants
│   └── Assets
│
├── Modules
│   │
│   ├── Auth
│   │   ├── Pages
│   │   ├── Components
│   │   ├── API
│   │   ├── Hooks
│   │   ├── Validation
│   │   └── Routes
│   │
│   ├── Dashboard
│   │   ├── Home
│   │   ├── Sidebar
│   │   ├── Topbar
│   │   ├── Widgets
│   │   ├── Cards
│   │   └── Routes
│   │
│   ├── Users
│   ├── Banks
│   ├── Reports
│   ├── Settings
│   ├── Notifications
│   └── ...
│
├── Store
│   ├── AuthStore
│   ├── ThemeStore
│   └── NotificationStore
│
└── Backend (Laravel)
    ├── Auth API
    ├── User
    ├── Roles
    ├── Permissions
    └── REST APIs






    Every React feature module must mirror its corresponding Laravel backend module whenever possible.

For example:

Backend
Modules/
├── Auth
├── Users
├── Banks
├── Reports
└── Settings
Frontend
modules/
├── auth
├── users
├── banks
├── reports
└── settings