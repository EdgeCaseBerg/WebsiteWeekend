Controller objects are created to perform specific operations on specific models. 

There are a few specalized controllers: 
- Controller.php is the hub of all requests, creating router objects,
  defining views, and displaying output
- Router.php performs the URL parsing
- View.php manages the handling of the output

** ALL OTHER CONTROLLERS MUST EXTEND AbstractController **

Controllers should not DIRECTLY interact with the data-store, rather it should interact with individual model objects and their methods, which in turn, manipulate the data-store

