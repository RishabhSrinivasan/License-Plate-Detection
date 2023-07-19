import os
import cv2
import numpy as np
import matplotlib.pyplot as plt
import easyocr
from email.message import EmailMessage
import ssl
import smtplib
import util
import mysql.connector
conn=mysql.connector.connect(host="localhost",user="root",password="",port="3306",database="licence")
i=4;
# define constants
model_cfg_path = os.path.join('.', 'model', 'cfg', 'darknet-yolov3.cfg')
model_weights_path = os.path.join('.', 'model', 'weights', 'model.weights')
class_names_path = os.path.join('.', 'model', 'class.names')

input_dir = 'C:/Users/HP/Desktop/timepass'

img_path = 'C:/Users/HP/Desktop/timepass/car1.png'
for img_name in os.listdir(input_dir):



    img_path = os.path.join(input_dir, img_name)

    # load class names
    with open(class_names_path, 'r') as f:
        class_names = [j[:-1] for j in f.readlines() if len(j) > 2]
        f.close()

    # load model
    net = cv2.dnn.readNetFromDarknet(model_cfg_path, model_weights_path)

    # load image

    img = cv2.imread(img_path)

    H, W, _ = img.shape

    # convert image
    blob = cv2.dnn.blobFromImage(img, 1 / 255, (416, 416), (0, 0, 0), True)

    # get detections
    net.setInput(blob)

    detections = util.get_outputs(net)

    # bboxes, class_ids, confidences
    bboxes = []
    class_ids = []
    scores = []

    for detection in detections:
        # [x1, x2, x3, x4, x5, x6, ..., x85]
        bbox = detection[:4]

        xc, yc, w, h = bbox
        bbox = [int(xc * W), int(yc * H), int(w * W), int(h * H)]

        bbox_confidence = detection[4]

        class_id = np.argmax(detection[5:])
        score = np.amax(detection[5:])

        bboxes.append(bbox)
        class_ids.append(class_id)
        scores.append(score)

    # apply nms
    bboxes, class_ids, scores = util.NMS(bboxes, class_ids, scores)

    # plot
    reader = easyocr.Reader(['en'])
    for bbox_, bbox in enumerate(bboxes):
        xc, yc, w, h = bbox

        """
        cv2.putText(img,
                    class_names[class_ids[bbox_]],
                    (int(xc - (w / 2)), int(yc + (h / 2) - 20)),
                    cv2.FONT_HERSHEY_SIMPLEX,
                    7,
                    (0, 255, 0),
                    15)
        """

        license_plate = img[int(yc - (h / 2)):int(yc + (h / 2)), int(xc - (w / 2)):int(xc + (w / 2)), :].copy()

        img = cv2.rectangle(img,
                            (int(xc - (w / 2)), int(yc - (h / 2))),
                            (int(xc + (w / 2)), int(yc + (h / 2))),
                            (0, 255, 0),
                            15)

        license_plate_gray = cv2.cvtColor(license_plate, cv2.COLOR_BGR2GRAY)

        _, license_plate_thresh = cv2.threshold(license_plate_gray, 64, 255, cv2.THRESH_BINARY_INV)

        output = reader.readtext(license_plate_thresh)

        for out in output:
            text_bbox, text, text_score = out
            print(text_score);
            if text_score > 0.2:
                print(text, text_score)
                mycursor = conn.cursor()

                sql = ("SELECT Balance FROM platers WHERE Number ='%s'"%text)



                mycursor.execute(sql)

                myresult = mycursor.fetchall()



                for x in myresult:
                    for y in x:
                        print("Enter val to be deducted:\n");
                        amt = input()
                        amt = int(amt)

                        sql = ("UPDATE platers SET Balance = %d WHERE Number = '%s'"%(y-amt,text))

                        mycursor.execute(sql)

                        conn.commit()

                        print(mycursor.rowcount, "record(s) affected")

            mycursor = conn.cursor()
            sql = ("SELECT Email FROM platers WHERE Number ='%s'" % text)
            mycursor.execute(sql)

            myresult = mycursor.fetchall()

            for x in myresult:
                for y in x:
                    email_sender = "rishabh.srinivasan@spit.ac.in"
                    email_password = "uogqmgytlkaxwwar"
                    email_reciver = y;

                    subject = "You Have been Fined"
                    body = ("You are fined %drs because of improper conduct and not obeying the Traffic Rules"%amt)


                    em = EmailMessage()

                    em['From'] = email_sender
                    em['To'] = email_reciver
                    em['Subject'] = subject

                    em.set_content(body)

                    context = ssl.create_default_context()

                    with smtplib.SMTP_SSL('smtp.gmail.com', 465, context=context) as smtp:
                        smtp.login(email_sender, email_password)
                        smtp.sendmail(email_sender, email_reciver, em.as_string())


















    plt.figure()
    plt.imshow(cv2.cvtColor(img, cv2.COLOR_BGR2RGB))

    plt.figure()
    plt.imshow(cv2.cvtColor(license_plate, cv2.COLOR_BGR2RGB))

    plt.figure()
    plt.imshow(cv2.cvtColor(license_plate_gray, cv2.COLOR_BGR2RGB))

    plt.figure()
    plt.imshow(cv2.cvtColor(license_plate_thresh, cv2.COLOR_BGR2RGB))

    plt.show()

