# nuki-rocket.chat-handler
A php file to handle the notifications send by Nuki Webhook and forward it to a Rocket.Chat channel as message by a bot user.


## How to:

1.  Register a notification webhook from Nuki API pointing to handler.php
2.  Create a new user and assign the **bot** and **user** roles on your Rocket.Chat server
3.  Generate a Personal Access Token and add the **token** and the **user id** to the handler.php
4.  Change the URL to your server to the handler.php



```
How does it work?
┌────────────────────────────────────────────────────────────────────────────────────┐
│                                                                                    │
│                                                                                    │
│                                                                                    │
│        Nuki API                                                Rocket.Chat         │
│        Webhook                                                    Server           │
│    ┌──────────────┐                                       ┌───────────────────┐    │
│    │ Notification │            ┌─────────────┐            │ Post Notification │    │
│    │    Event     │ ─────────► │ handler.php │ ─────────► │     as message    │    │
│    └──────────────┘            └─────────────┘            └───────────────────┘    │
│                                                                                    │
│                                                                                    │
│                                                                                    │
└────────────────────────────────────────────────────────────────────────────────────┘
```

