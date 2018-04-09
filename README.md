![](https://github.com/LA3QMA/PATPiBox/blob/master/img/preview.png)

# `$ raspap-webgui` [![Release 1.3.1](https://img.shields.io/badge/Release-1.3.1-green.svg)](https://github.com/billz/raspap-webgui/releases)
A simple, responsive web interface to control PAT (winlink client), wifi, hostapd and related services on the Raspberry Pi.

Based on [**raspap-webgui**](https://github.com/billz/raspap-webgui) using a web page rather than ssh to configure PAT settings on the Raspberry Pi. Includes [**SB Admin 2**](https://github.com/BlackrockDigital/startbootstrap-sb-admin-2), a Bootstrap based admin theme. 

## Contents

 - [Prerequisites](#prerequisites)
 - [Quick installer](#quick-installer)
 - [Manual installation](#manual-installation)
 - [Optional services](#optional-services)

## Prerequisites
You need to install some extra software in order for the Raspberry Pi to act as a WiFi router and access point. If all you're interested in is configuring your RPi as a client on an existing WiFi network, you can skip this step. 

There are many guides available to help you select a WiFi adapter, install a compatible driver, configure HostAPD and so on. The details are outside the scope of this project, although I've had consistently good results with the [**Edimax Wireless 802.11b/g/n nano USB adapter**](http://www.edimax.com/edimax/merchandise/merchandise_detail/data/edimax/global/wireless_adapters_n150/ew-7811un) – it's small, cheap and easy to work with.

To configure your RPi as a WiFi router, either of these resources will start you on the right track: 
* [**How-To: Use The Raspberry Pi As A Wireless Access Point/Router Part 1**](http://sirlagz.net/2012/08/09/how-to-use-the-raspberry-pi-as-a-wireless-access-pointrouter-part-1/)
* [**How-To: Turn a Raspberry Pi into a WiFi router**](http://raspberrypihq.com/how-to-turn-a-raspberry-pi-into-a-wifi-router/) (uses isc-dhcp-server instead of dnsmasq)

After you complete the intial setup, you'll be able to administer these services using the web UI.

## Quick installer
Install RaspAP from your RaspberryPi's shell prompt:
```sh
$ wget -q https://git.io/vx9EW -O /tmp/raspap && bash /tmp/raspap
```
The installer will complete the steps in the manual installation (below) for you.

After the reboot at the end of the installation the wireless network will be
configured as an access point as follows:
* IP address: 10.3.141.1
  * Username: admin
  * Password: secret
* DHCP range: 10.3.141.50 to 10.3.141.255
* SSID: `raspi-webgui`
* Password: ChangeMe

