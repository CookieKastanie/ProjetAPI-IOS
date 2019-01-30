//
//  Matieres.swift
//  AppliCours
//
//  Created by andre jeremy on 30/01/2019.
//  Copyright © 2019 ramousset vincent. All rights reserved.
//

import Foundation

struct Matieres: Codable {
    var idMat: String
    var libelle: String
    
    enum CodingKeys: String, CodingKey {
        case idMat
        case libelle
    }
    
    init(from decoder: Decoder) throws {
        let valueContainer = try decoder.container(keyedBy: CodingKeys.self)
        
        self.idMat = try valueContainer.decode(String.self, forKey: CodingKeys.idMat)
        self.libelle = try valueContainer.decode(String.self, forKey: CodingKeys.libelle)
    }
}
