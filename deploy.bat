@echo off
REM Deploy to GitHub Pages - Windows Batch Script

echo.
echo ========================================
echo GitHub Pages Deployment Script
echo ========================================
echo.

REM Check if in correct directory
if not exist frontend (
    echo ERROR: frontend folder not found. Run this from project root.
    pause
    exit /b 1
)

echo Step 1: Building frontend...
cd frontend
call npm run build
if errorlevel 1 (
    echo ERROR: Build failed
    pause
    exit /b 1
)
cd ..

echo.
echo Step 2: Pushing to GitHub...
git add .
git commit -m "Deploy: build frontend for GitHub Pages"
git push origin main

if errorlevel 1 (
    echo ERROR: Git push failed
    pause
    exit /b 1
)

echo.
echo ========================================
echo Deployment Started!
echo ========================================
echo.
echo GitHub Actions will now:
echo 1. Build your frontend
echo 2. Deploy to GitHub Pages
echo.
echo Check here for deployment status:
echo https://github.com/CharlesTBA/cs_web/actions
echo.
echo Your site will be available at:
echo https://charlestba.github.io/cs_web/
echo.
echo Note: GitHub Actions may take 1-2 minutes to complete.
echo.
pause
