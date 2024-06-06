const nodemailer = require('nodemailer');

export default async function (req, res) {
  if (req.method === 'POST') {
    const { name, email, project, message } = req.body;

    // Create a Nodemailer transporter using SMTP
    let transporter = nodemailer.createTransport({
      host: 'smtp.gmail.com',
      port: 587,
      secure: false, // true for 465, false for other ports
      auth: {
        user: 'usmankicsit2021@gmail.com', // your email
        pass: 'lqim uzof yqbt trzi',       // your app password
      },
    });

    try {
      // Send email using the transporter
      await transporter.sendMail({
        from: '"Contact Form" <usmankicsit2021@gmail.com>', // sender address
        to: 'usmankicsit2018@gmail.com',                   // recipient address
        subject: 'New Contact Form Submission',
        html: `<h2>Contact Form Submission</h2>
               <p><strong>Name:</strong> ${name}</p>
               <p><strong>Email:</strong> ${email}</p>
               <p><strong>Project:</strong> ${project}</p>
               <p><strong>Message:</strong><br>${message}</p>`,
        text: `Name: ${name}\nEmail: ${email}\nProject: ${project}\nMessage: ${message}`,
      });

      res.status(200).send('Thank you for contacting us!');
    } catch (error) {
      console.error('Error sending email:', error);
      res.status(500).send('Sorry, something went wrong. Please try again later.');
    }
  } else {
    res.status(405).send('Method Not Allowed');
  }
}
