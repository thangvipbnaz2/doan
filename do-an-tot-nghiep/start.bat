@echo off
title HànNgữ - Development Server
echo ============================================
echo   HànNgữ - Học Tiếng Trung Cho Người Việt
echo   PHP Development Server
echo ============================================
echo.
php -S localhost:8000 -t "%~dp0"
echo.
pause
