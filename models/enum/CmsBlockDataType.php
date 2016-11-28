<?php

namespace common\models\enu;

abstract class CmsBlockDataType extends BasicEnum {

	const FULL_CONTENT = 0; // banner large
	const LEFT_CONTENT = 1; // banner small
	const RIGHT_CONTENT = 2; // banner small
	const AUTO_CONTENT = 3; // banner small
	const TOP_CONTENT = 4; // banner small

	const CATEGORY_VIEW_LEFT = 1;
	const CATEGORY_VIEW_RIGHT = 2;
	const CATEGORY_VIEW_TOP =3;
	const CATEGORY_VIEW_LEFT_BOTTOM = 4;
	const CATEGORY_VIEW_RIGHT_BOTTOM = 5;
}
