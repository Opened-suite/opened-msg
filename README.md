# Opened Message

Opened Message is the new open-source instant messaging tool built on pure PHP, pure JavaScript, and pure CSS.

---

## Table of Contents
- [Opened Message](#opened-message)
  - [Table of Contents](#table-of-contents)
  - [How to Install Opened Message](#how-to-install-opened-message)
  - [How to Change Themes](#how-to-change-themes)
    - [The default color palette is as follows:](#the-default-color-palette-is-as-follows)
  - [Troubleshooting](#troubleshooting)
    - [If you encounter any issues:](#if-you-encounter-any-issues)
      



## How to Install Opened Message

Follow these steps to get *OpenedMessage* up and running:

1. Clone this GitHub repository using the command: `git@github.com:Opened-suite/opened-msg.git`, or download the repository directly from GitHub.
   
```bash
git clone git@github.com:Opened-suite/opened-msg.git
```
2. Execute the config.sql file.
Configure the config/config_db.php file with your SQL credentials.

3. That's it! We hope you enjoy the free service provided by Opened Suite, hosted by Heberking.


## How to Change Themes
### The default color palette is as follows:



```css

:root {
    --primary-dark-color-1: #10111A;
    --primary-dark-color-2: #212334;
    --primary-dark-color-3: #171725;
    --surface-dark-color-1: #4d4d4d;
    --surface-dark-color-2: #3c3c3c;
    --surface-dark-color-3: #1e1e1e;
    --mixed-dark-color-1: #495057;
    --mixed-dark-color-2: #343a40;
    --mixed-dark-color-3: #212529;
    --text-dark-color-1: #EFEFEF;
    --text-dark-color-2: #CCCCCC;
    --link-dark-color-1: #a688fa;
    --link-dark-color-2: #000;
}
```
If you wish to customize it, navigate to the `style/shared.css` file and modify the colors within the :root selector.

## Troubleshooting
### If you encounter any issues:

* You can try reinstalling OpenedSuite and Apache/Nginx to resolve them.
* If the problem persists, please contact our support team at heberking.service@gmail.com.