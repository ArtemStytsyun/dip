from flask import Flask, jsonify, request
import cv2
import numpy as np
import os
from skimage.metrics import structural_similarity as ssim

app = Flask(__name__)

@app.route('/boards', methods=['post'])


def index():
    # Путь к папке с картинками
    image_folder = '..\\storage\\app\\public\\usersImages'

    # Выбранные цветные картинки
    images = request.get_json()
    target_images = []
    # print(images)
    for image in images['images']:
        # print(image)
        target_image = '..\\storage\\app\\public\\' + image['path'].replace('/', '\\')
        target_images.append(target_image)
       

    # Нахождение похожих изображений
    similar_images = find_similar_images(target_images, image_folder, num_similar=10)
    for image_path, similarity in similar_images:
        print(f"Похожесть: {similarity}, Изображение: {image_path}")
    return jsonify(similar_images)

def compare_histograms(hist1, hist2):
    """Вычисляет сходство между гистограммами"""
    return cv2.compareHist(hist1, hist2, cv2.HISTCMP_CORREL)

def get_image_histogram(image_path):
    """Вычисляет гистограмму изображения"""
    image = cv2.imread(image_path)
    hsv_image = cv2.cvtColor(image, cv2.COLOR_BGR2HSV)
    hist = cv2.calcHist([hsv_image], [0, 1], None, [180, 256], [0, 180, 0, 256])
    cv2.normalize(hist, hist, alpha=0, beta=1, norm_type=cv2.NORM_MINMAX)
    return hist

def find_similar_images(target_images, image_folder, num_similar=10):
    """Находит наиболее похожие изображения на основе гистограмм"""
    target_histograms = [get_image_histogram(image) for image in target_images]
    similar_images = []

    for root, dirs, files in os.walk(image_folder):
        for file in files:
            image_path = os.path.join(root, file)
            if image_path not in target_images:
                histogram = get_image_histogram(image_path)
                similarity = max([compare_histograms(hist, histogram) for hist in target_histograms])
                similar_images.append((image_path, similarity))

    similar_images.sort(key=lambda x: x[1], reverse=True)
    return similar_images[:num_similar]

if __name__ == '__main__':
    app.run(port=5001)
