INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(495, 0, 'plg_twofactorauth_trust', 'plugin', 'trust', 'twofactorauth', 0, 0, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);
INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description_key`, `action_key`, `language_extension`, `language_client_id`, `type`, `action_file`, `action`, `condition_file`, `condition_method`, `version_introduced`, `enabled`)
VALUES
(700, 'PLG_TWOFACTORAUTH_TRUST_POSTINSTALL_TITLE', 'PLG_TWOFACTORAUTH_TRUST_POSTINSTALL_BODY', '', 'plg_twofactorauth_trust', 1, 'message', '', '', '', '', '3.9.0', 1);
