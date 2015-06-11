# S-money-API-Client-PHP
PHP Client API updated by Laurent Sorba.

Forked from S-money/S-money-API-Client-PHP
Used some fixes from spyrit/S-money-API-Client-PHP

- [X] Fixes from spyrit
  - [X] Update UserProfile.php: The format recognized by the API is not ATOM but "Y-m-d\TH:i:s"
  - [X] Fix encoding in Country.php
  - [X] Allow false as value for JSON: When $ismine is false, it is seen as an empty value and therefore not written in the JSON output. Fix this.
- [ ] Improvements
  - [ ] Support of an URL callback
  - [ ] Support of scheduled payments

