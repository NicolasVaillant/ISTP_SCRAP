from m5stack import *
from m5ui import *
from uiflow import *
import urequests

setScreenColor(0x000000)


formatted_next = None
jour = None
formatted = None



label0 = M5TextBox(0, 0, "Text", lcd.FONT_UNICODE, 0x00ff01, rotate=0)
label1 = M5TextBox(0, 116, "Text", lcd.FONT_UNICODE, 0xff0000, rotate=0)
label2 = M5TextBox(0, 41, "Text", lcd.FONT_Ubuntu, 0xFFFFFF, rotate=0)
label3 = M5TextBox(0, 158, "Text", lcd.FONT_Ubuntu, 0xffffff, rotate=0)
label5 = M5TextBox(258, 0, "Text", lcd.FONT_Default, 0xFFFFFF, rotate=0)


# Fetch class from php files and display it
def AfficherEDT():
  global formatted_next, jour, formatted
  label2.setText('Chargement...')
  label3.setText('Chargement...')
  label5.setText(str('DONE'))
  try:
    req = urequests.request(method='GET', url=(str(formatted) + str(((str('?day=') + str(jour))))), headers={})
    label2.setText(str(req.text))
  except:
    label2.setText('ERROR')
  try:
    req = urequests.request(method='GET', url=(str(formatted_next) + str(((str('?day=') + str(jour))))), headers={})
    label3.setText(str(req.text))
  except:
    label3.setText('ERROR')


def buttonB_wasPressed():
  global formatted_next, jour, formatted
  jour = jour - 1
  AfficherEDT()
  pass
btnB.wasPressed(buttonB_wasPressed)

def buttonC_wasPressed():
  global formatted_next, jour, formatted
  jour = jour + 1
  AfficherEDT()
  pass
btnC.wasPressed(buttonC_wasPressed)


jour = 0
setScreenColor(0x000000)
label0.setText('Actuellement')
label1.setText('Prochainement')
# -------------------------------------
# Project relative path
# Must be hosted on a web server
formatted_next = 'php/formatted_next.php'
formatted = 'php/formatted.php'
# -------------------------------------
AfficherEDT()
