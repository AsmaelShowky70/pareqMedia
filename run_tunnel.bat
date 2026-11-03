@echo off
title Pariq Agency Cloudflare Tunnel
echo ======================================================
echo  Pariq Agency - Public Tunnel for Client Demo
echo ======================================================
cloudflared.exe tunnel --url http://127.0.0.1:8000
pause
