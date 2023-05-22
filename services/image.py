from flask import Flask, jsonify, request
import cv2
import numpy as np
import os
from skimage.metrics import structural_similarity as ssim

app = Flask(__name__)

@app.route('/images', methods=['post'])

def index():
    path = request.get_json()

    target_image = '..\\storage\\app\\public\\' + path['path'].replace('/', '\\')
    folder_path = '..\\storage\\app\\public\\usersImages'
    top_k = 5
    print(path['path'])

    similar_images = find_similar_images(target_image, folder_path, top_k)

    return jsonify(similar_images)

def compare_images(image1, image2):
    img1 = cv2.imread(image1)
    img1 = cv2.resize(img1, (600, 600), interpolation=cv2.INTER_AREA)
    img2 = cv2.imread(image2)
    img2 = cv2.resize(img2, (600, 600), interpolation=cv2.INTER_AREA)
    
    img1 = cv2.cvtColor(img1, cv2.COLOR_BGR2RGB)
    img2 = cv2.cvtColor(img2, cv2.COLOR_BGR2RGB)
    
    similarity = ssim(img1, img2, channel_axis = 2, win_size=7)
    
    return similarity

def find_similar_images(target_image, folder_path, top_k):
    target_img_path = os.path.join(target_image)
    target_img_path = os.path.abspath(target_img_path)
    similar_images = []

    for image_file in os.listdir(folder_path):
        if image_file != target_image:
            image_path = os.path.join(folder_path, image_file)
            image_path = os.path.abspath(image_path)
            print (image_path)
            similarity = compare_images(target_img_path, image_path)
            similar_images.append((image_file, similarity))

    similar_images = sorted(similar_images, key=lambda x: x[1], reverse=True)

    top_k_similar = similar_images[:top_k]

    return top_k_similar

if __name__ == '__main__':
    app.run(port=5000)
