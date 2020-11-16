# machine-gallery
The project above displays a table of industrial machines that can be filtered by brand, manufacturer, model and by a range of prices. The front-end has been done in React and the back-end in symfony 5.1.8.

During the development, the app has been running  on a Homestead Vagrant box, but is ready to run at any php server, just take into account that the project needs node.js and yarn to run the fron-end part.

![alt text](https://github.com/joseprigo/machine-gallery/blob/master/blob/overview.png?raw=true)

Backend

This project tries to take advantage of symfony dependency injection of services and the default components of the framework as much as possible.

Enities

Machine and image:  The entities which appear on the test specifications. Both entities represent a one-to-many relation As one machine can have many images.
Symfony will incorporate uuids natively in 5.2 version but since now need additional dependencies and to avoid possible breaking points in the app, The uuids have been used only for display and all the entities have more common ids with autoincremental values.

User: entity created to provide some security when editing the machines data.

Controllers

There could be less controllers but it’s better to divide them into specific tasks to avoid huge controllers with too many imports from unused resources. 
I used notation for the Security and the Routing.

Forms

Forms are normally used to pass info from a render of a twig template to a controller. However they can be useful while getting data from external sources, like a react front-end, as is the case. The only difference is than in this case, the data has to be decoded from a json string instead of having a entity binded internally by symfony.

Repositories

The image and the machine repositoy share a trait to find a register by uuid. I saw this on a tutorial and I thought it would be really handy for an hypothetical future development of the project. Besides it helps integrate the uuid with the workflow of the application. 

Other services

I add a service that return a serializer. Symfony works with Entities, and the front-end expects json objects. There are two possible ways here: use arrays in the back-end, losing many of the advantatges of the Doctrine Enities and being less efficient. The other is to work with entities as in any symfony app and serialize them just before sending a response to the react part. I chose the latter.

Unit tests

there are some unittests asserting the response from calling certain routes.

Config
The configuration  files are pretty much the default ones. I edited some parts of the security.yml files but I’m not sure they are that useful when working with a separate front-end logic.

Frontend

The front-end reads the list of machines and shows them as a table.
The design has been done with a modified bootstrap template.
There are three components: the home, the Machines and the login. Most of the action happens in the Machines.js component. All the front-end elements required on the spcefications of the app happen here. The component loads the results, filtered and unfiltered.


![alt text](https://github.com/joseprigo/machine-gallery/blob/master/blob/filterbytext.png?raw=true)

Filtering by price
![alt text](https://github.com/joseprigo/machine-gallery/blob/master/blob/pricefilter.png?raw=true)


I created an additional compoent with a login but the connection between the front and the back-end is still to be integrated.

![alt text](https://github.com/joseprigo/machine-gallery/blob/master/blob/login.png?raw=true)

Extra points

filters: there are filters on the top of the table, allowing the user to filter by a text (can be a brand, manufacturer or model) and a price range.
Containers: I used vagrant during the development. I have a homestead machine with all my symfony projects running in my computer.
Testing: there’s controller testing, which is not the default test that comes with symfony
Other features: I added the serializer, the uuid dependencies and at least at the back-end there are some rules to secure the routes that interact with the database.






