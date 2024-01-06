```
---+-----+-----
 1 | {1} |{56}
---+-----+-----
 2 | 57  |{71}
---+-----+-----
 3 | 72  | 85
---+-----+-----
 4 |{86} |{89}
---+-----+-----
 5 | 90  | 94
---+-----+-----
 6 | 95  | 102
---+-----+-----
 7 | 103 |{171}
---+-----+-----
 8 | 172 | 206
---+-----+-----
```

```
import pandas as pd
import numpy as np

# Make numpy values easier to read.
np.set_printoptions(precision=3, suppress=True)

import tensorflow as tf
from tensorflow.keras import layers

abalone_train = pd.read_csv(
    "https://storage.googleapis.com/download.tensorflow.org/data/abalone_train.csv",
    names=["Length", "Diameter", "Height", "Whole weight", "Shucked weight",
           "Viscera weight", "Shell weight", "Age"])

abalone_train.head()
abalone_features = abalone_train.copy()
abalone_labels = abalone_features.pop('Age')
abalone_features = np.array(abalone_features)
abalone_features

abalone_model = tf.keras.Sequential([
  layers.Dense(64),
  layers.Dense(1)
])

abalone_model.compile(loss = tf.keras.losses.MeanSquaredError(),
                      optimizer = tf.keras.optimizers.Adam())
abalone_model.fit(abalone_features, abalone_labels, epochs=10)
```

[![default](https://user-images.githubusercontent.com/8466209/200127121-3ead6276-c908-495d-9ddf-9c858258f8f8.png)](https://colab.research.google.com/github/tensorflow/docs/blob/master/site/en/tutorials/load_data/csv.ipynb#scrollTo=uZdpCD92SN3Z)

[![default](https://user-images.githubusercontent.com/8466209/200127760-db1529e5-d019-46c3-a283-1fe8119d2fc8.png)](https://archive.ics.uci.edu/ml/datasets/abalone)
