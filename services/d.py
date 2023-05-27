import tensorflow as tf

print("Доступные GPU:")
gpus = tf.config.list_physical_devices('GPU')
for gpu in gpus:
    print(gpu)
tf.config.experimental.set_visible_devices(gpus[0], 'GPU')