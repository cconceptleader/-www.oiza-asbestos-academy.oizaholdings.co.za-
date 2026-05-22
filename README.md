# OIZA Asbestos Academy

Welcome to the OIZA Asbestos Academy portal. This repository hosts the frontend for the academy's learning management system.

## Quick Start

This repository is configured for GitHub Pages hosting at:
```
www.oiza-asbestos-academy.oizaholdings.co.za
```

### Repository Structure

```
├── CNAME                          # Custom domain configuration
├── DEPLOYMENT_INSTRUCTIONS.md     # Complete deployment guide
├── README.md                      # This file
└── index.html                     # Main portal landing page
```

## Architecture

### Frontend (GitHub Pages)
- **Domain:** www.oiza-asbestos-academy.oizaholdings.co.za
- **Hosting:** GitHub Pages
- **Technology:** HTML, CSS, JavaScript
- **Repository:** cconceptleader/-www.oiza-asbestos-academy.oizaholdings.co.za-

### Backend (Separate Hosting)
- **Domain:** api.oiza-asbestos-academy.oizaholdings.co.za
- **Technology:** PHP + MySQL
- **Hosted:** Separate PHP hosting provider
- **Features:**
  - Learner authentication
  - Course management
  - Assessment tracking
  - Certificate generation

## Deployment

For complete deployment instructions, see [DEPLOYMENT_INSTRUCTIONS.md](DEPLOYMENT_INSTRUCTIONS.md)

### Key Steps:
1. Configure GitHub Pages custom domain
2. Set up DNS CNAME record
3. Deploy PHP backend separately
4. Import MySQL database schema
5. Enable HTTPS

## Configuration

**Repository Owner:** cconceptleader

**Custom Domain:** www.oiza-asbestos-academy.oizaholdings.co.za

**CNAME Record Target:** cconceptleader.github.io

**Backend API Domain:** api.oiza-asbestos-academy.oizaholdings.co.za

## Features (Ready for Development)

- [x] Frontend portal template
- [x] GitHub Pages configuration
- [x] Custom domain setup (CNAME)
- [x] Deployment instructions
- [ ] Login system (pending backend deployment)
- [ ] Learner registration (pending backend deployment)
- [ ] Assessment forms (pending backend deployment)
- [ ] Certificate PDF generation (pending backend deployment)

## Getting Started

1. **Review** [DEPLOYMENT_INSTRUCTIONS.md](DEPLOYMENT_INSTRUCTIONS.md) for step-by-step setup
2. **Configure** GitHub Pages in repository settings
3. **Set up** DNS CNAME record at your registrar
4. **Deploy** PHP backend to separate hosting
5. **Test** frontend-backend API communication

## Support

For GitHub Pages specific questions, refer to:
- [GitHub Pages Documentation](https://docs.github.com/en/pages)
- [Custom Domain Troubleshooting](https://docs.github.com/en/pages/configuring-a-custom-domain-for-your-github-pages-site/troubleshooting-custom-domains-and-github-pages)

## Next Steps

The production version with full features (login, registration, assessments, certificates) is ready for deployment. Once the current setup is live, we can upgrade to:

- User authentication system
- Learner registration portal
- Assessment management
- Certificate PDF generation
- Analytics and reporting

---

**Status:** ✅ Deployment-Ready
**Version:** 1.0.0
**Last Updated:** 2026-05-22