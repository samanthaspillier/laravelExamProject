# Malawi Travel Agency Website

Welcome to Malawian Tour, a Web Advanced School Project.
This projects is designed to provide information about traveling in Malawi, including tours and travel requirements

To book a tour, don't hesitate to contact us

## Features

- **Travel Posts**: Detailed posts about various travel destinations and attractions in Malawi.
- **FAQ Section**: Frequently asked questions with answers related to travel in Malawi.
- **Contact Form**: Allows users to send inquiries or suggestions, including requesting new FAQ entries.
- **Admin Dashboard**: Manage and respond to contact messages and update FAQs. (only for registred administrators)

## Installation

To set up the project on your local machine, follow these steps:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/your-username/malawi-travel-agency.git
   ```

2. **Navigate to the Project Directory**

   ```bash
   cd malawi-travel-agency
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

6. **Run Migrations**

   ```bash
   php artisan migrate
   ```

7. **Seed the Database**

   ```bash
   php artisan db:seed
   ```

8. **Serve the Application**

   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your browser to view the website.

## Usage

- **Browse Posts**: Explore detailed posts about travel destinations in Malawi.
- **FAQ**: Find answers to common travel questions.
- **Contact Us**: Use the contact form to send inquiries or feedback.
- **Admin Dashboard**: For administrators, manage contact messages and update FAQs.

## Contributing

We welcome contributions to enhance this project. If you have suggestions or want to report issues, please create a pull request or open an issue in the repository.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Acknowledgments

This project includes information and inspiration from various sources, including [Malawi Tour](https://malawiantour.wixsite.com/malawiantour-en).
```

Save this content to a file named `README.md` and place it in the root directory of your Git project.