<?php
/**
 * Simples CMS core configuration
 * 
 */

// Maximum lenght of the content snippet in an admin table cell
Configure::write('Simples.table.maxlength', 20);

// Maximum lenght of the parent page select box item
Configure::write('Simples.pages.maxparents', 100);

// Login cookie
Configure::write('Simples.cookie.name', 'SimplesUser');
Configure::write('Simples.cookie.expire', 2592000); // 30 days

// Turn Gzip compression on/off
Configure::write('Simples.useGzip', false);

// Uploads directory
Configure::write('Simples.uploadDirectory', APP . WEBROOT_DIR .  DS . 'uploads');

/** Name of the posts index page in the URL */
define('SIMPLES_POSTS_INDEX', 'blog');
/** Contastant used in CmsHelper */
define('CHILD_PAGES_PLEASE', 'CHILD_PAGES_PLEASE');
