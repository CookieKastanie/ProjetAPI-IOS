//
//  Niveaux.swift
//  AppliCours
//
//  Created by andre jeremy on 30/01/2019.
//  Copyright © 2019 ramousset vincent. All rights reserved.
//

import Foundation

struct Niveaux: Codable {
    var idNiveau: String
    var libelle: String
    
    enum CodingKeys: String, CodingKey {
        case idNiveau
        case libelle
    }
    
    init(from decoder: Decoder) throws {
        let valueContainer = try decoder.container(keyedBy: CodingKeys.self)
        
        self.idNiveau = try valueContainer.decode(String.self, forKey: CodingKeys.idNiveau)
        self.libelle = try valueContainer.decode(String.self, forKey: CodingKeys.libelle)
    }
}
