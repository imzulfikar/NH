<?php return [
  'service' => [
    'actions' => [
      'CreateStack' => [
        'request' => [
          'operation' => 'CreateStack',
        ],
        'resource' => [
          'type' => 'Stack',
          'identifiers' => [
            [
              'target' => 'Name',
              'source' => 'requestParameter',
              'path' => 'StackName',
            ],
          ],
        ],
      ],
    ],
    'has' => [
      'Event' => [
        'resource' => [
          'type' => 'Event',
          'identifiers' => [
            [
              'target' => 'Id',
              'source' => 'input',
            ],
          ],
        ],
      ],
      'Stack' => [
        'resource' => [
          'type' => 'Stack',
          'identifiers' => [
            [
              'target' => 'Name',
              'source' => 'input',
            ],
          ],
        ],
      ],
    ],
    'hasMany' => [
      'Stacks' => [
        'request' => [
          'operation' => 'DescribeStacks',
        ],
        'resource' => [
          'type' => 'Stack',
          'identifiers' => [
            [
              'target' => 'Name',
              'source' => 'response',
              'path' => 'Stacks[].StackName',
            ],
          ],
        ],
      ],
    ],
  ],
  'resources' => [
    'Event' => [
      'identifiers' => [
        [
          'name' => 'Id',
          'memberName' => 'EventId',
        ],
      ],
      'shape' => 'StackEvent',
    ],
    'Stack' => [
      'identifiers' => [
        [
          'name' => 'Name',
          'memberName' => 'StackName',
        ],
      ],
      'shape' => 'Stack',
      'load' => [
        'request' => [
          'operation' => 'DescribeStacks',
          'params' => [
            [
              'target' => 'StackName',
              'source' => 'identifier',
              'name' => 'Name',
            ],
          ],
        ],
        'path' => 'Stacks[0]',
      ],
      'actions' => [
        'CancelUpdate' => [
          'request' => [
            'operation' => 'CancelUpdateStack',
            'params' => [
              [
                'target' => 'StackName',
                'source' => 'identifier',
                'name' => 'Name',
              ],
            ],
          ],
        ],
        'Delete' => [
          'request' => [
            'operation' => 'DeleteStack',
            'params' => [
              [
                'target' => 'StackName',
                'source' => 'identifier',
                'name' => 'Name',
              ],
            ],
          ],
        ],
        'Update' => [
          'request' => [
            'operation' => 'UpdateStack',
            'params' => [
              [
                'target' => 'StackName',
                'source' => 'identifier',
                'name' => 'Name',
              ],
            ],
          ],
        ],
      ],
      'has' => [
        'Resource' => [
          'resource' => [
            'type' => 'StackResource',
            'identifiers' => [
              [
                'target' => 'StackName',
                'source' => 'identifier',
                'name' => 'Name',
              ],
              [
                'target' => 'LogicalId',
                'source' => 'input',
              ],
            ],
          ],
        ],
      ],
      'hasMany' => [
        'Events' => [
          'request' => [
            'operation' => 'DescribeStackEvents',
            'params' => [
              [
                'target' => 'StackName',
                'source' => 'identifier',
                'name' => 'Name',
              ],
            ],
          ],
          'resource' => [
            'type' => 'Event',
            'identifiers' => [
              [
                'target' => 'Id',
                'source' => 'response',
                'path' => 'StackEvents[].EventId',
              ],
            ],
            'path' => 'StackEvents[]',
          ],
        ],
        'ResourceSummaries' => [
          'request' => [
            'operation' => 'ListStackResources',
            'params' => [
              [
                'target' => 'StackName',
                'source' => 'identifier',
                'name' => 'Name',
              ],
            ],
          ],
          'resource' => [
            'type' => 'StackResourceSummary',
            'identifiers' => [
              [
                'target' => 'LogicalId',
                'source' => 'response',
                'path' => 'StackResourceSummaries[].LogicalResourceId',
              ],
              [
                'target' => 'StackName',
                'source' => 'requestParameter',
                'path' => 'StackName',
              ],
            ],
            'path' => 'StackResourceSummaries[]',
          ],
        ],
      ],
    ],
    'StackResource' => [
      'identifiers' => [
        [
          'name' => 'StackName',
        ],
        [
          'name' => 'LogicalId',
          'memberName' => 'LogicalResourceId',
        ],
      ],
      'shape' => 'StackResourceDetail',
      'load' => [
        'request' => [
          'operation' => 'DescribeStackResource',
          'params' => [
            [
              'target' => 'LogicalResourceId',
              'source' => 'identifier',
              'name' => 'LogicalId',
            ],
            [
              'target' => 'StackName',
              'source' => 'identifier',
              'name' => 'StackName',
            ],
          ],
        ],
        'path' => 'StackResourceDetail',
      ],
      'has' => [
        'Stack' => [
          'resource' => [
            'type' => 'Stack',
            'identifiers' => [
              [
                'target' => 'Name',
                'source' => 'identifier',
                'name' => 'StackName',
              ],
            ],
          ],
        ],
      ],
    ],
    'StackResourceSummary' => [
      'identifiers' => [
        [
          'name' => 'StackName',
        ],
        [
          'name' => 'LogicalId',
          'memberName' => 'LogicalResourceId',
        ],
      ],
      'shape' => 'StackResourceSummary',
      'has' => [
        'Resource' => [
          'resource' => [
            'type' => 'StackResource',
            'identifiers' => [
              [
                'target' => 'LogicalId',
                'source' => 'identifier',
                'name' => 'LogicalId',
              ],
              [
                'target' => 'StackName',
                'source' => 'identifier',
                'name' => 'StackName',
              ],
            ],
          ],
        ],
      ],
    ],
  ],
];
