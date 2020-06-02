# Temporary Email made with PHP

You can check its live version at [billieiscute.xyz](https://billieiscute.xyz/temp/)

PHP-Temporary-Email is self-hosted temporary email library. You can use it on any website that has PHP IMAP

## Installation

Clone this repositary

```bash
git clone https://github.com/mattprocoder/PHP-Temporary-Email
```
Install IMAP for php (Linux)
```bash
sudo apt-get install php5-imap
sudo php5enmod imap
```
Install IMAP for php (MacOS)
```bash
brew reinstall php56 --with-imap
```

Open 'assets/php/get-imap-details.php'
Set IMAP connection details in format
```php
imap_open("{address}", "username", "password");
```
Set other details such as delete timeframe and so on.


## Usage

After this you can deploy the repo on your server.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[GPL-3.0](https://www.gnu.org/licenses/gpl-3.0.html)
