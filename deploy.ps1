#!/usr/bin/env pwsh

# Deploy to GitHub Pages - PowerShell Script

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "GitHub Pages Deployment Script" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if in correct directory
if (-not (Test-Path "frontend")) {
    Write-Host "ERROR: frontend folder not found. Run this from project root." -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host "Step 1: Building frontend..." -ForegroundColor Yellow
Push-Location frontend
npm run build
if ($LASTEXITCODE -ne 0) {
    Write-Host "ERROR: Build failed" -ForegroundColor Red
    Pop-Location
    Read-Host "Press Enter to exit"
    exit 1
}
Pop-Location

Write-Host ""
Write-Host "Step 2: Pushing to GitHub..." -ForegroundColor Yellow
git add .
git commit -m "Deploy: build frontend for GitHub Pages"
git push origin main

if ($LASTEXITCODE -ne 0) {
    Write-Host "ERROR: Git push failed" -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "Deployment Started!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "GitHub Actions will now:" -ForegroundColor Green
Write-Host "1. Build your frontend" -ForegroundColor Green
Write-Host "2. Deploy to GitHub Pages" -ForegroundColor Green
Write-Host ""
Write-Host "Check deployment status:" -ForegroundColor Cyan
Write-Host "https://github.com/CharlesTBA/cs_web/actions"
Write-Host ""
Write-Host "Your site will be available at:" -ForegroundColor Cyan
Write-Host "https://charlestba.github.io/cs_web/"
Write-Host ""
Write-Host "Note: GitHub Actions may take 1-2 minutes to complete." -ForegroundColor Yellow
Write-Host ""
Read-Host "Press Enter to exit"
