from flask import Flask, render_template, request
from googletrans import Translator

app = Flask(__name__)

@app.route("/", methods=["GET", "POST"])
def home():
    translation = ""
    if request.method == "POST":
        text = request.form["text"]
        lang = request.form["language"]
        
        # Initialize the Translator
        translator = Translator()
        
        # Translate the text
        translation = translator.translate(text, dest=lang).text

    return render_template("index.html", translation=translation)

if __name__ == "__main__":
    app.run(debug=True)
