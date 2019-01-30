//
//  URLHelper.swift
//  AppliCours
//
//  Created by andre jeremy on 30/01/2019.
//  Copyright © 2019 ramousset vincent. All rights reserved.
//

import Foundation

class URlHelper: NSObject {
    let api = "http://www-etu.iut-bm.univ-fcomte.fr/~vramouss/Code/api/"
    var objet: String
    var methode: String
    
    init(objet: String, methode:String) {
        self.objet = objet
        self.methode = methode
    }
    
    func getURL() -> URL {
        return URL(string: api + objet + "/" + methode + ".php")!
    }
    
    func setObjet(objet: String){
        self.objet = objet
    }
    
    func setMethode(methode: String){
        self.methode = methode
    }
}

extension URL {
    func withQueries(_ queries: [String: String]) -> URL? {
        
        var components = URLComponents(url: self, resolvingAgainstBaseURL: true)
        components?.queryItems = queries.map { URLQueryItem(name: $0.0, value: $0.1)}
        return components?.url
    }
}
