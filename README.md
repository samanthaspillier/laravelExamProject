# Malawi Travel Agency Website

Welcome to Malawian Tour, a Web Advanced School Project.
This projects is designed to provide information about traveling in Malawi, including tours and travel requirements

To book a tour, don't hesitate to contact us

## Features

- **Travel Posts**: Detailed posts about various travel destinations and attractions in Malawi.
- **User Profile**: Your account settings and a profile page visible to all users.
- **About**: Acknowledgements
- **FAQ Section**: Frequently asked questions with answers related to travel in Malawi.
- **Contact Form**: Allows users to send inquiries or suggestions, including requesting new FAQ entries.
- **Admin Dashboard**: Manage and respond to contact messages and update FAQs.

## Installation

To set up the project on your local machine, follow these steps:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/samanthaspillier/laravelExamProject.git
   ```

2. **Navigate to the Project Directory**

   ```bash
   cd examLaravel
   ```

3. **Install Dependencies**

   Ensure you have Composer installed. Run:

   ```bash
   composer install
   ```

4. **Set Up Environment Variables**

   Copy the `.env.example` file to `.env` and update the database and other configurations as needed.

   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

6. **Run Migrations and Seed the Database**

   ```bash
   php artisan php artisan migrate:fresh --seed
   ```

7. **Serve the Application**

   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your browser to view the website.

## Usage

- **Browse Posts**: Explore detailed posts about travel destinations in Malawi.
- **User Profile**: After having registered, update your settings and share a little bit about yourself.
- **About**: See all the acknowledgements of this project
- **FAQ**: Find answers to common travel questions.
- **Contact Us**: Use the contact form to send inquiries or feedback.
- **Admin Dashboard**: For administrators only, manage contact messages and update FAQs.

## Contributing

We welcome contributions to enhance this project. If you have suggestions or want to report issues, please create a pull request or open an issue in the repository.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Acknowledgments

This project includes information and inspiration from various sources, including:
- [Malawi Tour](https://malawiantour.wixsite.com/malawiantour-en).
- [ChatGPT](https://chatgpt.com/share/fd2526b2-aa5f-4002-982b-21e156de8e6d)
- [Laravel Documentation](https://laravel.com/docs/11.x/)
- [DuckDuckGo Images](https://duckduckgo.com/?q=avatar+red+default&iar=images&iax=images&ia=images&iai=https%3A%2F%2Fi.pinimg.com%2F474x%2F40%2Fea%2Fdc%2F40eadc62e563d9f506bee2182d9d5ee0.jpg)
- [online image converter](https://www.freeconvert.com/png-to-ico/download)

```

