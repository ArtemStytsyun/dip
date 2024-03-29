from flask import Flask, request
import json
import numpy as np
from tensorflow.keras.applications.resnet50 import ResNet50, preprocess_input
from tensorflow.keras.preprocessing import image
from sklearn.metrics.pairwise import cosine_similarity
import os

app = Flask(__name__)
model = ResNet50(weights='imagenet', include_top=False, pooling='avg')

@app.route('/boards', methods=['post'])

def index():
    image_folder = '..\\storage\\app\\public\\usersImages'

    images = request.get_json()
    target_images = []
    for image in images['images']:
        target_image = '..\\storage\\app\\public\\' + image['path'].replace('/', '\\')
        target_images.append(target_image)    

    similar_images = find_similar_images(target_images, image_folder, num_similar=10)
    for image_path, similarity in similar_images:
        print(f"Похожесть: {similarity}, Изображение: {image_path}")
    json_data = json.dumps(similar_images, indent=4, ensure_ascii=False)
    return json_data

def extract_features(image_path):
    img = image.load_img(image_path, target_size=(200, 200))
    #преобразование в массив
    img = image.img_to_array(img) 
    #добавление размерности пакета
    img = np.expand_dims(img, axis=0) 
    #нормализация, центрирование пикселей
    img = preprocess_input(img) 
    #векторное представление изображения, которое содержит высокоуровневую абстракцию особенностей изображения
    features = model.predict(img) 
    #одномерный массив
    features = features.flatten() 
    return features.tolist()  

def find_similar_images(target_images, image_folder, num_similar=10):
    target_features = [extract_features(image) for image in target_images]
    similar_images = []

    for root, dirs, files in os.walk(image_folder):
        for file in files:
            image_path = os.path.join(root, file)
            if image_path not in target_images:
                image_feature = extract_features(image_path)
                #список, содержащий значения косинусного сходства между каждой парой изображений
                similarities = [cosine_similarity([image_feature], [target_feature])[0][0] for target_feature in target_features] 
                similarity = max(similarities)
                similar_images.append((image_path, similarity))

    similar_images.sort(key=lambda x: x[1], reverse=True)
    return similar_images[:num_similar]

if __name__ == '__main__':
    app.run(port=5001)
