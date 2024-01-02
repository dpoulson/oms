# OrganiseMyStuff

OMS is an open source inventory system geared around a single individual, or small groups such as a hack/make space or even a school. Items are stored in boxes, on shelves, at a location. This could be literal boxes on shelves, or maybe a drawer in a cabinet. You can either use our hosted solution, or host your own on a simple LAMP stack.

### Features
* Teams allow multiple people to access a single resource, and be members of multiple teams
* Simplified stock quantities. Too many of a thing to count, turn off quantity and just have a flag for if inventory gets low. 

### Initial features
* QR codes/labels to print out
* easy bulk import from a spreadsheet
* export to a spreadsheet
* Allow putting in part numbers for major suppliers to auto fill fields (datasheet, image, notes, etc.)
* Upload a BOM for a project to automatically tell you if items are in stock, and allow you to reduce the quantities.
* Reactive for use on web pages


### Later features
* docker deploy
* AWS automatic deploy
* API/Websocket for linking to lights for easy display of stock location
* Scan of barcode in webapp to decrement quantity