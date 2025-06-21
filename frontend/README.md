Vue 3 + Vite Frontend

This is a Vue 3 frontend project scaffolded with Vite, using modern Vue 3. Tailwind CSS is used for styling.

## Features

- Vue 3 with `<script setup>` SFCs for clean, concise components
- Tailwind CSS for utility-first responsive styling
- Connects to Laravel 12 backend API at `http://localhost:8000/api`
- Categories and Products CRUD UI via API calls

---

## Prerequisites

- Node.js (recommended >= 16)
- npm
- Git

---

## Setup Instructions (Run Locally)

1. **Clone the repo**

```bash
git clone https://github.com/Rajan225263/creative_tech_rajan.git
Go to frontend directory

cd project-root/frontend
Install dependencies

npm install

Configure environment variables
Create a .env file at the project root (project-root/frontend/.env) with:

VITE_API_BASE_URL=http://localhost:8000/api

Run development server:

npm run dev
Open app in browser
http://localhost:5173
