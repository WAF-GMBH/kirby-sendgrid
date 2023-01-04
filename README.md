# Sendgrid for Kirby
This plugin replaces Kirby's native email component with SendGrid. The 
implementation is optimized for use with kikokostadinov.com. It may need 
tweaking if used for other Kirby-based projects.

- This plugin requires Kirby 3.8 or higher
- This plugin uses the SendGrid API V3

## Installation
1. Copy all files in this repo to `/site/plugins/kirby-sendgrid/`.
2. Run `composer install` to install the SendGrip PHP Library.
3. If it does not exist yet, create `/site/config/env.php` and export your 
SendGrid API key as an environment variable: 
`putenv("SENDGRID_API_KEY=[API key goes here]");`
