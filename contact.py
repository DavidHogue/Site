# vim: tabstop=8 expandtab shiftwidth=4 softtabstop=4
import smtplib
from email.mime.text import MIMEText
import time
from flask import Flask
from flask import request

my_email = "david@davidhogue.com"
smtp_server = "localhost"

app = Flask(__name__)

@app.route("/", methods=['POST'])
def send():
    msg = MIMEText(request.form['message'])
    msg['Subject'] = "Contact Form " + time.strftime('%d/%m/%Y %H:%M')
    msg['From'] = request.form['from']
    msg['To'] = my_email

    smtp = smtplib.SMTP(smtp_server)
    smtp.sendmail(my_email, my_email, msg.as_string())
    smtp.quit()

    return "Sent!"

if __name__ == "__main__":
    app.run(port=2000, debug=True)
