#!/usr/bin/env python
# coding: utf-8

# In[25]:


# Import the neccessary modules for data manipulation and visual representation
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import matplotlib as matplot
import cv2
import os
import keras
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Dense, Flatten, Dropout, Activation, Conv2D, MaxPooling2D


# In[12]:


from os import listdir
from numpy import asarray
from numpy import save
from keras.preprocessing.image import load_img
from keras.preprocessing.image import img_to_array
# define location of dataset
folder = 'C:/Users/user/Desktop/cnic/'
photos, labels = list(), list()
# enumerate files in the directory
for file in listdir(folder):
    # determine class
    output = 0.0
    if file.startswith('urdu'):
        output = 1.0
    # load image
    photo = load_img(folder + file, target_size=(500, 500))
    # convert to numpy array
    photo = img_to_array(photo)
    # store
    photos.append(photo)
    labels.append(output)
# convert to a numpy arrays
photos = asarray(photos)
labels = asarray(labels)
print(photos.shape, labels.shape)


# In[13]:


from sklearn.model_selection import train_test_split
photos= photos/255.0
X_train, X_test, y_train, y_test = train_test_split( photos, labels, test_size=0.2, random_state=42)


# In[14]:


X_train.shape


# In[17]:


# define cnn model
from tensorflow.keras.optimizers import SGD
def define_model():
    model = Sequential()
    model.add(Conv2D(32, (3, 3), activation='relu', kernel_initializer='he_uniform', padding='same',input_shape=(500, 500, 3)))
    model.add(MaxPooling2D((2, 2)))
    model.add(Flatten())
    model.add(Dense(128, activation='relu', kernel_initializer='he_uniform'))
    model.add(Dense(1, activation='sigmoid'))
    # compile model
    opt = SGD(lr=0.001, momentum=0.9)
    model.compile(optimizer=opt, loss='binary_crossentropy', metrics=['accuracy'])
    return model


# In[18]:


model = define_model()


# In[19]:


classification_cnic = model.fit(X_train, y_train, epochs=10, validation_data=(X_test, y_test), batch_size=6, verbose=1)


# In[20]:


plt.plot(classification_cnic.history['loss'])
plt.plot(classification_cnic.history['val_loss'])
plt.legend(['training', 'validation'])
plt.title('Loss')
plt.xlabel('Epoch')


# In[ ]:




