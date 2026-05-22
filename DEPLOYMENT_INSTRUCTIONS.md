# Deployment Instructions

## GitHub Pages Configuration

In GitHub Pages, set the custom domain to `www.oiza-asbestos-academy.oizaholdings.co.za`, then wait for the DNS check to succeed before turning on **Enforce HTTPS**, which GitHub documents in the Pages settings flow.

**Reference:** [Securing your GitHub Pages site with HTTPS](https://docs.github.com/en/pages/getting-started-with-github-pages/securing-your-github-pages-site-with-https)

## DNS Configuration

At your DNS provider, create a CNAME record for `www.oiza-asbestos-academy` pointing to `cconceptleader.github.io`, because GitHub's guidance for subdomains uses the owner's Pages domain as the target.

**DNS Record Configuration:**
- **Type:** CNAME
- **Name:** www.oiza-asbestos-academy
- **Target:** cconceptleader.github.io

**Reference:** [Using GitHub Pages with Custom Domain](https://www.pluralsight.com/resources/blog/guides/using-github-pages-with-custom-domain)

## Backend and Database Architecture

The frontend package is ready for GitHub Pages, but the PHP backend and MySQL database must be hosted separately, since GitHub Pages does not execute PHP.

**Reference:** [GitHub Pages URLs](https://heardlibrary.github.io/digital-scholarship/manage/control/github/pages-urls/)

### Production Architecture

A practical production split is to keep the portal on `www.oiza-asbestos-academy.oizaholdings.co.za` and host the API at `api.oiza-asbestos-academy.oizaholdings.co.za`, with MySQL attached to that PHP environment.

**Frontend:** `www.oiza-asbestos-academy.oizaholdings.co.za`
- GitHub Pages (static assets)
- HTML, CSS, JavaScript

**Backend API:** `api.oiza-asbestos-academy.oizaholdings.co.za`
- PHP application server
- MySQL database
- Authentication, learner data, assessments

## Deployment Steps

### 1. Repository Setup
- Repository: `cconceptleader/-www.oiza-asbestos-academy.oizaholdings.co.za-`
- Default branch: `main`
- CNAME file: Already configured

### 2. GitHub Pages Configuration
1. Go to repository Settings → Pages
2. Set custom domain to: `www.oiza-asbestos-academy.oizaholdings.co.za`
3. Wait for DNS check to complete
4. Enable **Enforce HTTPS** (only after DNS verification)

### 3. DNS Configuration
1. Log into your DNS provider
2. Create CNAME record:
   - **Name:** www.oiza-asbestos-academy
   - **Type:** CNAME
   - **Value:** cconceptleader.github.io
3. Wait for DNS propagation (typically 5-48 hours)

### 4. CNAME File Format
The CNAME file in this repository must:
- Be named `CNAME` (uppercase)
- Contain only one line: the domain name
- Have no trailing whitespace or extra lines

Current CNAME content:
```
www.oiza-asbestos-academy.oizaholdings.co.za
```

### 5. HTTPS Activation
- GitHub will automatically provision an SSL certificate once DNS is verified
- Enable **Enforce HTTPS** in Pages settings after DNS verification succeeds
- This ensures all traffic is encrypted

**Reference:** [Troubleshooting Custom Domains and GitHub Pages](https://docs.github.com/en/pages/configuring-a-custom-domain-for-your-github-pages-site/troubleshooting-custom-domains-and-github-pages)

## PHP Backend Deployment

### Prerequisites
- PHP 7.4+ hosting environment
- MySQL 5.7+ database
- SSH/SFTP access or deployment tool

### Deployment Steps
1. Set up PHP environment at `api.oiza-asbestos-academy.oizaholdings.co.za`
2. Configure database connection strings
3. Import MySQL schema and initial data
4. Set up environment variables for credentials
5. Configure CORS headers to allow requests from the frontend domain
6. Test API endpoints from frontend

### MySQL Configuration
1. Create database for learner management
2. Set up authentication tables
3. Create assessment and certificate tables
4. Import initial data in correct order:
   - Users/authentication data
   - Course and assessment structure
   - Initial learner records (if any)

## Go-Live Checklist

- [ ] CNAME file created and pushed to repository
- [ ] DNS CNAME record created at registrar
- [ ] DNS propagation verified (use `nslookup` or similar)
- [ ] GitHub Pages custom domain configured
- [ ] GitHub Pages DNS check passed
- [ ] HTTPS enabled and certificate provisioned
- [ ] Frontend accessible at `www.oiza-asbestos-academy.oizaholdings.co.za`
- [ ] PHP backend deployed to separate hosting
- [ ] MySQL database configured and accessible
- [ ] API endpoints tested and working
- [ ] CORS properly configured for frontend-backend communication
- [ ] SSL certificate on backend API (if applicable)
- [ ] Monitoring and logging configured
- [ ] Backups configured for MySQL database

## Support Resources

- [GitHub Pages Documentation](https://docs.github.com/en/pages)
- [Custom Domain Troubleshooting](https://docs.github.com/en/pages/configuring-a-custom-domain-for-your-github-pages-site/troubleshooting-custom-domains-and-github-pages)
- [GitHub Pages HTTPS](https://docs.github.com/en/pages/getting-started-with-github-pages/securing-your-github-pages-site-with-https)

---

**Configuration Details:**
- Owner: cconceptleader
- Repository: -www.oiza-asbestos-academy.oizaholdings.co.za-
- Frontend Domain: www.oiza-asbestos-academy.oizaholdings.co.za
- Backend Domain: api.oiza-asbestos-academy.oizaholdings.co.za
- Backend Type: PHP + MySQL
- Deployment Date: 2026-05-22