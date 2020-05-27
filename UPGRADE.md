# Upgrade Guide

## Config File

### Likelihood of impact - High

In the config file we now by default use ZOOM_CLIENT_KEY and ZOOM_CLIENT_SECRET, v1 we used ZOOM_CLIENT and ZOOM_SECRET, you will need to update your .env file or change the vendor published config file.