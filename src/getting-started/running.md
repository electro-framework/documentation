# Running the web application

### If you have the Apache web server installed

All you have to do now is to open, on your browser, the localhost URL corresponding to the project's folder.

You should see a welcome page.

### Using the built-in development server

The framework comes with its own built-in web server, suitable for development only. If you do not whish to install Apache on your computer, you may use it instead.

To start the server type:

```bash
workman server:start
```

The application will be available at `http://localhost:8000`.

> You may change the IP, port and other settings via command line options. Run `workman help server:start` to find out more.
