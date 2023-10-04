import React from "react";
import { TableContainer, Table, Tr, Td, Tbody } from "@chakra-ui/react";
import { formatNumber } from "../../utils/utils";

const HeroVaissDetails = ({ infos, isHero }) => {
    const { vie, vitesse, protection, degatCritique, puissance, tenacite,
        volVie, degatPhysique, ccPhysique, degatSpeciaux, ccSpeciaux } = infos;
    return <TableContainer>
        <Table variant='striped' colorScheme='gray'>
          <Tbody>
            <Tr>
              <Td>Vie</Td>
              <Td isNumeric>{ formatNumber(vie) }</Td>
            </Tr>
            <Tr>
              <Td>Protection</Td>
              <Td isNumeric>{ formatNumber(protection) }</Td>
            </Tr>
            <Tr>
              <Td>Vitesse</Td>
              <Td isNumeric>{ formatNumber(vitesse) }</Td>
            </Tr>
            {isHero && <Tr>
              <Td>Dégât critique</Td>
              <Td isNumeric>{ formatNumber(degatCritique) }</Td>
            </Tr>}
            <Tr>
              <Td>Puissance</Td>
              <Td isNumeric>{ formatNumber(puissance) }</Td>
            </Tr>
            <Tr>
              <Td>Ténacité</Td>
              <Td isNumeric>{ `${formatNumber(tenacite)} %` }</Td>
            </Tr>
            {isHero && <Tr>
              <Td>Vol de vie</Td>
              <Td isNumeric>{ formatNumber(volVie) }</Td>
            </Tr>}
            <Tr>
              <Td>Dégâts physiques</Td>
              <Td isNumeric>{ formatNumber(degatPhysique) }</Td>
            </Tr>
            <Tr>
              <Td>Chance de coup critique des dégâts physiques</Td>
              <Td isNumeric>{ `${formatNumber(ccPhysique)} %` }</Td>
            </Tr>
            <Tr>
              <Td>Dégâts spéciaux</Td>
              <Td isNumeric>{ formatNumber(degatSpeciaux) }</Td>
            </Tr>
            <Tr>
              <Td>Chance de coup critique des dégâts spéciaux</Td>
              <Td isNumeric>{ `${formatNumber(ccSpeciaux)} %` }</Td>
            </Tr>
          </Tbody>
        </Table>
      </TableContainer>
  }

export default HeroVaissDetails;