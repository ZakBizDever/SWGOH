
import React from "react";
import { Button, Icon } from '@chakra-ui/react';
import { FaSortNumericDownAlt, FaSortNumericUpAlt, FaSortAlphaDownAlt, FaSortAlphaUpAlt } from "react-icons/fa";

const SortField = ({ name, order, type, currentSort, index, changeSort}) => {
    const sortIcon = (currentSort === index)
                      ? (type === 'number')
                          ? (order === 'asc')
                            ? FaSortNumericUpAlt
                            : FaSortNumericDownAlt
                          : (order === 'asc')
                            ? FaSortAlphaUpAlt
                            : FaSortAlphaDownAlt
                      : (type === 'number') ? FaSortNumericUpAlt : FaSortAlphaUpAlt;
    const bgColor = (currentSort === index) ? 'red' : 'gray';
    return <Button variant='solid' colorScheme={bgColor}  rightIcon={<Icon as={sortIcon} />}  onClick={() => changeSort(index)}>
          {name}
        </Button>
}

export default SortField;